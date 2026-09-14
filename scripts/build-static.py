#!/usr/bin/env python3
"""
Convert the GBI PHP marketing site into fully static HTML for Azure Static
Web Apps.

See STATIC-CONVERSION.md for the full include map and the reasoning behind
each transform below.

What this handles
-----------------
The site uses PHP for three things, across two levels of include:

  1. partials/header.php  - included directly by every page. Contains a PHP
     FUNCTION (__gbi_nav_active) called at 5 places, so the header renders
     DIFFERENTLY on every page depending on the $NAV_ACTIVE value the page
     sets. This script renders it per page; it does not paste a fixed block.

  2. partials/footer.php  - included directly by every page. Safe to inline
     as text, EXCEPT that it ends with a third include...

  3. feedback-widget.php  - pulled in transitively by the footer, so it
     reaches all 28 production pages. Review tooling. Stripped here.

URL shape
---------
Output is directory-style (extensionless):

    site/index.php               ->  dist/index.html                    ( / )
    site/careers.php             ->  dist/careers/index.html            ( /careers/ )
    site/about/our-story.php     ->  dist/about/our-story/index.html    ( /about/our-story/ )
    site/services/index.php      ->  dist/services/index.html           ( /services/ )
    site/404.php                 ->  dist/404.html                      (special case)

Internal links are rewritten to match, so no internal click ever costs a
redirect hop.

Safety net
----------
After building, this script asserts that ZERO "<?php" survives anywhere in
the output and exits non-zero if any does. That single check catches every
class of failure this converter has had.

Usage
-----
    python scripts/build-static.py <source_dir> <output_dir>
    python scripts/build-static.py site dist
"""

from __future__ import annotations

import json
import re
import shutil
import sys
from pathlib import Path

# -----------------------------------------------------------------------------
# Files that must never reach production
# -----------------------------------------------------------------------------

# Review / pre-launch tooling. These carry real server-side logic ($_POST,
# $_FILES, disk writes) and are not production pages. tag-review.php is listed
# explicitly because it ALSO includes the shared partials, so any "convert
# everything that includes a partial" logic would otherwise pick it up.
EXCLUDED_FILES = {
    "feedback.php",
    "feedback-test.php",
    "feedback-widget.php",
    "fb-board.php",
    "tag-review.php",
}

# Directories never copied: server-only partials, and the feedback JSON store
# plus its uploaded screenshots if a local review run created one.
EXCLUDED_DIRS = {"partials", "feedback-data"}

# Pages that map to a bare .html at the site root rather than a directory.
ROOT_HTML_PAGES = {"404.php"}


# -----------------------------------------------------------------------------
# Patterns
# -----------------------------------------------------------------------------

# The page-level include lines. The header form optionally carries a
# $NAV_ACTIVE assignment ahead of the include on the same line.
HEADER_INCLUDE_RE = re.compile(
    r"<\?php\s*"
    r"(?:\$NAV_ACTIVE\s*=\s*['\"](?P<nav>[a-zA-Z_-]+)['\"]\s*;\s*)?"
    r"(?://[^\n]*\n\s*)?"
    r"include\s+\$_SERVER\[['\"]DOCUMENT_ROOT['\"]\]\s*\.\s*"
    r"['\"]/partials/header\.php['\"]\s*;\s*\?>",
    re.IGNORECASE,
)

FOOTER_INCLUDE_RE = re.compile(
    r"<\?php\s+include\s+\$_SERVER\[['\"]DOCUMENT_ROOT['\"]\]\s*\.\s*"
    r"['\"]/partials/footer\.php['\"]\s*;\s*\?>",
    re.IGNORECASE,
)

# The transitive widget include that lives INSIDE partials/footer.php, plus the
# HTML comment above it. Both are stripped when the footer is inlined.
WIDGET_INCLUDE_RE = re.compile(
    r"<\?php\s+include[^?]*?feedback-widget\.php[^?]*?\?>\s*",
    re.IGNORECASE,
)
REVIEW_COMMENT_RE = re.compile(
    r"<!--\s*REVIEW PHASE ONLY.*?-->\s*",
    re.DOTALL | re.IGNORECASE,
)

# The 5 nav-state calls inside partials/header.php. Two of them are wrapped in
# trim(), which is why the optional trim( group and trailing ) are here.
#   <?php echo __gbi_nav_active('about', $__nav_active); ?>
#   <?php echo trim(__gbi_nav_active('projects', $__nav_active)); ?>
NAV_CALL_RE = re.compile(
    r"<\?php\s+echo\s+(?P<trim>trim\(\s*)?"
    r"__gbi_nav_active\(\s*['\"](?P<key>[a-zA-Z_-]+)['\"]\s*,\s*\$__nav_active\s*\)"
    r"\s*\)?\s*;\s*\?>",
    re.IGNORECASE,
)

# Rewrites href/src/action ending in .php to the directory-style URL.
# External URLs (http://, https://, //, mailto:, tel:, #) are left alone.
LINK_PHP_RE = re.compile(
    r'((?:href|src|action)\s*=\s*)'
    r'([\'"])'
    r'((?!https?://|//|mailto:|tel:|#)[^\'"]*?)\.php'
    r'([?#][^\'"]*)?'
    r'\2',
    re.IGNORECASE,
)

# Strips the leading <?php ... ?> docblock from a partial so only markup remains.
#
# The closing ?> must be anchored to the start of a line. Both partials embed a
# usage example inside their docblock that itself ends in "?>", so a plain
# non-greedy ".*?\?>" stops at that example and dumps the REST of the docblock
# -- including header.php's function definition -- into the page as visible
# text. That is a real bug this converter shipped with; do not "simplify" this
# pattern back.
LEADING_PHP_BLOCK_RE = re.compile(r'^\s*<\?php.*?^\?>\s*', re.DOTALL | re.MULTILINE)

# Final safety assertion. Checks the closing tag too: a partially-stripped
# docblock leaks markup that contains "?>" but no "<?php".
ANY_PHP_RE = re.compile(r'<\?php|\?>', re.IGNORECASE)


# -----------------------------------------------------------------------------
# Static Web Apps config
# -----------------------------------------------------------------------------

# External origins the site actually loads from, collected from the source.
# CSP ships as Report-Only so it cannot break the site: verify against real
# traffic in the browser console, then rename the header to enforce it.
CSP_REPORT_ONLY = (
    "default-src 'self'; "
    "script-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://cdn.jsdelivr.net; "
    "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; "
    "font-src 'self' https://fonts.gstatic.com; "
    "img-src 'self' data: https:; "
    "frame-src https://player.vimeo.com https://apply.workable.com; "
    "connect-src 'self' https:; "
    "base-uri 'self'; "
    "form-action 'self' https://apply.workable.com; "
    "frame-ancestors 'self'"
)

STATICWEBAPP_CONFIG = {
    # No navigationFallback: this is a multi-page site, not a SPA. Falling back
    # to index.html would return 200 for every bad URL, which is bad for users
    # and actively harmful for SEO.
    "routes": [
        {
            "route": "/assets/*",
            "headers": {"cache-control": "public, max-age=31536000, immutable"},
        }
    ],
    "responseOverrides": {
        "404": {"rewrite": "/404.html", "statusCode": 404},
    },
    "mimeTypes": {
        ".json": "application/json",
        ".webp": "image/webp",
        ".avif": "image/avif",
    },
    "globalHeaders": {
        "cache-control": "public, max-age=0, must-revalidate",
        "x-content-type-options": "nosniff",
        "x-frame-options": "SAMEORIGIN",
        "referrer-policy": "strict-origin-when-cross-origin",
        "strict-transport-security": "max-age=31536000; includeSubDomains",
        "content-security-policy-report-only": CSP_REPORT_ONLY,
    },
}


# -----------------------------------------------------------------------------
# URL + path mapping
# -----------------------------------------------------------------------------

def php_link_to_url(path: str) -> str:
    """Map a .php link target (extension already stripped) to a directory URL."""
    if path == "index":
        return "./"
    if path.endswith("/index"):
        return path[: -len("index")]     # "/services/index" -> "/services/"
    return path + "/"                    # "/about/our-story" -> "/about/our-story/"


def php_path_to_output(rel: Path) -> Path:
    """Map a source .php path to its output path."""
    if rel.name in ROOT_HTML_PAGES:
        return rel.with_suffix(".html")          # 404.php -> 404.html
    if rel.name == "index.php":
        return rel.with_name("index.html")       # services/index.php -> services/index.html
    return rel.with_suffix("") / "index.html"    # about/x.php -> about/x/index.html


def rewrite_links(text: str) -> str:
    def _sub(m: re.Match[str]) -> str:
        attr, quote, path, tail = m.group(1), m.group(2), m.group(3), m.group(4) or ""
        return f'{attr}{quote}{php_link_to_url(path)}{tail}{quote}'
    return LINK_PHP_RE.sub(_sub, text)


# -----------------------------------------------------------------------------
# Partial rendering
# -----------------------------------------------------------------------------

def render_header(header_src: str, nav_active: str) -> str:
    """Render partials/header.php for one page's $NAV_ACTIVE value.

    __gbi_nav_active() returns ' is-active' or ' ' -- a single SPACE, not an
    empty string. The trim()-wrapped call sites collapse that to ''. Both are
    reproduced exactly so the output matches what PHP would have emitted.
    """
    body = LEADING_PHP_BLOCK_RE.sub("", header_src, count=1)

    def _sub(m: re.Match[str]) -> str:
        value = " is-active" if m.group("key") == nav_active else " "
        return value.strip() if m.group("trim") else value

    return NAV_CALL_RE.sub(_sub, body).strip() + "\n"


def render_footer(footer_src: str) -> str:
    """Render partials/footer.php, stripping the transitive widget include."""
    body = LEADING_PHP_BLOCK_RE.sub("", footer_src, count=1)
    body = REVIEW_COMMENT_RE.sub("", body)
    body = WIDGET_INCLUDE_RE.sub("", body)
    return body.strip() + "\n"


def rewrite_page(text: str, header_src: str, footer_html: str) -> str:
    """Inline both partials into one page, then rewrite its links."""
    def _header_sub(m: re.Match[str]) -> str:
        return render_header(header_src, m.group("nav") or "")

    text = HEADER_INCLUDE_RE.sub(_header_sub, text)
    text = FOOTER_INCLUDE_RE.sub(lambda _m: footer_html, text)
    return rewrite_links(text)


# -----------------------------------------------------------------------------
# Build
# -----------------------------------------------------------------------------

def build(src_dir: Path, out_dir: Path) -> int:
    header_partial = src_dir / "partials" / "header.php"
    footer_partial = src_dir / "partials" / "footer.php"
    for p in (header_partial, footer_partial):
        if not p.exists():
            sys.exit(f"ERROR: expected partial at {p} - is the source dir correct?")

    header_src = header_partial.read_text(encoding="utf-8")
    footer_html = render_footer(footer_partial.read_text(encoding="utf-8"))

    if out_dir.exists():
        shutil.rmtree(out_dir)
    out_dir.mkdir(parents=True)

    pages, assets, skipped = 0, 0, 0

    for src_path in sorted(src_dir.rglob("*")):
        if src_path.is_dir():
            continue
        rel = src_path.relative_to(src_dir)

        if rel.parts and rel.parts[0] in EXCLUDED_DIRS:
            skipped += 1
            continue
        if rel.name in EXCLUDED_FILES:
            skipped += 1
            continue
        if rel.name == ".htaccess":
            # Apache-only. SWA uses staticwebapp.config.json instead.
            skipped += 1
            continue

        if src_path.suffix.lower() == ".php":
            dest = out_dir / php_path_to_output(rel)
            dest.parent.mkdir(parents=True, exist_ok=True)
            dest.write_text(
                rewrite_page(src_path.read_text(encoding="utf-8"), header_src, footer_html),
                encoding="utf-8",
            )
            pages += 1
            continue

        dest = out_dir / rel
        dest.parent.mkdir(parents=True, exist_ok=True)
        shutil.copy2(src_path, dest)
        assets += 1

    (out_dir / "staticwebapp.config.json").write_text(
        json.dumps(STATICWEBAPP_CONFIG, indent=2), encoding="utf-8"
    )

    print(f"Built {pages} pages, copied {assets} assets, skipped {skipped} server-only files -> {out_dir}/")

    # --- safety net: no PHP may survive into the output -----------------------
    leaked = [
        p for p in out_dir.rglob("*.html")
        if ANY_PHP_RE.search(p.read_text(encoding="utf-8"))
    ]
    if leaked:
        print(f"\nFAILED: {len(leaked)} output file(s) still contain raw PHP:")
        for p in leaked[:20]:
            print(f"  - {p.relative_to(out_dir)}")
        if len(leaked) > 20:
            print(f"  ... and {len(leaked) - 20} more")
        return 1

    if not (out_dir / "404.html").exists():
        print("WARNING: no 404.html in output, but staticwebapp.config.json "
              "references it. Add site/404.php.")

    print("OK: no raw PHP in output.")
    return 0


def main() -> None:
    if len(sys.argv) != 3:
        sys.exit(f"Usage: {sys.argv[0]} <source_dir> <output_dir>")
    src = Path(sys.argv[1]).resolve()
    out = Path(sys.argv[2]).resolve()
    if not src.is_dir():
        sys.exit(f"ERROR: source dir not found: {src}")
    sys.exit(build(src, out))


if __name__ == "__main__":
    main()
