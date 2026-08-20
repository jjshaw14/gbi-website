#!/usr/bin/env python3
"""
Convert the GBI PHP marketing site into fully static HTML for Azure Static
Web Apps (or any static host).

What it does
------------
The site uses PHP for exactly one thing: a single one-line include of the
shared footer partial on every page:

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php'; ?>

This script:

  1. Reads the footer partial once, stripping the surrounding <?php ?>
     header comment so only the HTML body remains.
  2. Walks every .php file under the source directory.
  3. Replaces the include line with the actual footer HTML.
  4. Rewrites internal href/src links that end in ".php" to end in ".html".
  5. Writes the result to the output directory, renaming .php → .html.
  6. Copies every other asset (images, CSS, JS, .htaccess replacement,
     etc.) through unchanged.
  7. Emits a staticwebapp.config.json so SWA serves index.html for
     directory requests and applies sensible cache headers.

Usage
-----
    python scripts/build-static.py <source_dir> <output_dir>

Example
-------
    python scripts/build-static.py site dist

Output structure mirrors the source: /about/our-story.html, /services/
index.html, etc. The /partials/ folder is NOT copied because it's only
referenced server-side.
"""

from __future__ import annotations

import json
import re
import shutil
import sys
from pathlib import Path

# -----------------------------------------------------------------------------
# Patterns
# -----------------------------------------------------------------------------

# Matches the specific footer include line used across the site.
# Whitespace-tolerant so slight formatting variations still match.
FOOTER_INCLUDE_RE = re.compile(
    r"<\?php\s+include\s+\$_SERVER\[['\"]DOCUMENT_ROOT['\"]\]\s*\.\s*"
    r"['\"]/partials/footer\.php['\"]\s*;\s*\?>",
    re.IGNORECASE,
)

# Rewrites href="foo.php" or href='foo.php' or src="foo.php" to .html,
# preserving quoting style, query strings, and hash fragments.
# Only rewrites URLs that are relative or start with /. External URLs
# (http://, https://, //, mailto:, tel:) are untouched.
LINK_PHP_RE = re.compile(
    r'((?:href|src|action)\s*=\s*)'          # attribute
    r'([\'"])'                               # opening quote
    r'((?!https?://|//|mailto:|tel:|#)[^\'"]*?)\.php'   # relative path .php
    r'([?#][^\'"]*)?'                        # optional query/fragment
    r'\2',                                   # closing quote
    re.IGNORECASE,
)

# Strip the leading <?php ... ?> block from footer.php so only markup remains.
LEADING_PHP_BLOCK_RE = re.compile(r'^\s*<\?php.*?\?>\s*', re.DOTALL)


# -----------------------------------------------------------------------------
# Static Web Apps config
# -----------------------------------------------------------------------------

STATICWEBAPP_CONFIG = {
    "routes": [],
    "navigationFallback": {
        "rewrite": "/index.html",
        "exclude": ["/assets/*", "/*.{png,jpg,jpeg,gif,svg,webp,ico,css,js,json,woff,woff2,ttf,eot,mp4,pdf}"],
    },
    "mimeTypes": {
        ".json": "application/json",
        ".webp": "image/webp",
    },
    "globalHeaders": {
        "cache-control": "public, max-age=0, must-revalidate"
    },
    "responseOverrides": {
        "404": {
            "rewrite": "/404.html",
            "statusCode": 404
        }
    }
}


# -----------------------------------------------------------------------------
# Helpers
# -----------------------------------------------------------------------------

def load_footer(footer_path: Path) -> str:
    """Load partials/footer.php and return its HTML body (no PHP tags)."""
    raw = footer_path.read_text(encoding="utf-8")
    stripped = LEADING_PHP_BLOCK_RE.sub("", raw, count=1)
    return stripped.strip() + "\n"


def rewrite_page(text: str, footer_html: str) -> str:
    """Apply the two transforms: inline the footer, rewrite .php links."""
    # Inline the footer include
    text = FOOTER_INCLUDE_RE.sub(lambda _m: footer_html, text)
    # Rewrite href/src=".../foo.php" to ".../foo.html"
    def _link_sub(m: re.Match[str]) -> str:
        attr, quote, path, tail = m.group(1), m.group(2), m.group(3), m.group(4) or ""
        return f'{attr}{quote}{path}.html{tail}{quote}'
    text = LINK_PHP_RE.sub(_link_sub, text)
    return text


def build(src_dir: Path, out_dir: Path) -> None:
    footer_partial = src_dir / "partials" / "footer.php"
    if not footer_partial.exists():
        sys.exit(f"❌ Expected footer partial at {footer_partial} — is source dir correct?")
    footer_html = load_footer(footer_partial)

    # Fresh output directory
    if out_dir.exists():
        shutil.rmtree(out_dir)
    out_dir.mkdir(parents=True)

    page_count = 0
    asset_count = 0
    skipped_count = 0

    for src_path in src_dir.rglob("*"):
        if src_path.is_dir():
            continue
        rel = src_path.relative_to(src_dir)

        # Skip the partials directory entirely — it was server-side only.
        if rel.parts and rel.parts[0] == "partials":
            skipped_count += 1
            continue

        # .php pages → transform and rename to .html
        if src_path.suffix.lower() == ".php":
            html_out = out_dir / rel.with_suffix(".html")
            html_out.parent.mkdir(parents=True, exist_ok=True)
            transformed = rewrite_page(
                src_path.read_text(encoding="utf-8"),
                footer_html,
            )
            html_out.write_text(transformed, encoding="utf-8")
            page_count += 1
            continue

        # .htaccess is Apache-only; SWA replaces it with staticwebapp.config.json.
        if src_path.name == ".htaccess":
            skipped_count += 1
            continue

        # Everything else — copy through
        dest = out_dir / rel
        dest.parent.mkdir(parents=True, exist_ok=True)
        shutil.copy2(src_path, dest)
        asset_count += 1

    # Write staticwebapp.config.json at repo root of the built site
    (out_dir / "staticwebapp.config.json").write_text(
        json.dumps(STATICWEBAPP_CONFIG, indent=2), encoding="utf-8"
    )

    print(f"✅ Built {page_count} pages, copied {asset_count} assets, "
          f"skipped {skipped_count} server-only files → {out_dir}/")


def main() -> None:
    if len(sys.argv) != 3:
        sys.exit(f"Usage: {sys.argv[0]} <source_dir> <output_dir>")
    src = Path(sys.argv[1]).resolve()
    out = Path(sys.argv[2]).resolve()
    if not src.is_dir():
        sys.exit(f"❌ Source dir not found: {src}")
    build(src, out)


if __name__ == "__main__":
    main()
