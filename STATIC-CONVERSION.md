# Static conversion reference

**Status: pre-conversion. Read this before touching any `.php` file in `site/`.**

This documents every server-side dependency in the site and what has to
change to ship it as static HTML on Azure Static Web Apps. It exists
because the include structure is deeper than it looks, and the pieces
that break are invisible until they reach production.

Audited against commit `ec762e1` on 2026-09-14.

---

## 1. The include graph

`CLAUDE.md` describes two include lines per page. There are actually
**three includes reaching every page, across two levels**, plus a PHP
function that renders differently on every page:

```
Every production page (28 files)
│
├── partials/header.php            ← included directly
│   └── __gbi_nav_active()         ← PHP FUNCTION, 5 call sites
│                                     renders DIFFERENTLY per page
│
└── partials/footer.php            ← included directly
    └── feedback-widget.php        ← TRANSITIVE — nothing on the page
                                      references it, but it reaches all
                                      28 pages through the footer
```

The transitive include is the dangerous one. `partials/footer.php:87`
ends with:

```php
<?php include dirname(__DIR__) . '/feedback-widget.php'; ?>
```

Anything that inlines the footer as raw text drags that line along with
it. That is exactly what happens today (see §4).

### Include inventory

| Include | Declared in | Pages affected | Static conversion |
|---|---|---|---|
| `partials/header.php` | Each page, line ~14 | 28 | Must be **rendered**, not pasted — 6 variants (§2) |
| `partials/footer.php` | Each page, last line | 28 | Safe to paste as text, **after** stripping its own include |
| `feedback-widget.php` | `partials/footer.php:87` | 28 (transitive) | **Delete** — review tooling, must not ship |

### Files that are NOT production pages

These carry real server-side logic — `$_POST`, `$_FILES`, disk writes —
and must be excluded from the build entirely, not converted:

```
site/feedback.php          site/feedback-test.php     site/tag-review.php
site/fb-board.php          site/feedback-widget.php
```

`site/tag-review.php` also pulls in `partials/header.php` and
`partials/footer.php`, so it will be picked up by any naive "convert
every file that includes a partial" logic. Exclude it explicitly.

---

## 2. The header is not static text

`partials/header.php:17-19` defines a function:

```php
function __gbi_nav_active($key, $current) {
  return $current === $key ? ' is-active' : ' ';
}
```

It is called at 5 places to mark the current section. The header
therefore produces **6 distinct HTML outputs** depending on the
`$NAV_ACTIVE` value the page sets before including it.

Note the return value is `' is-active'` or `' '` — a **single space**,
not an empty string. Inactive items render as `class="nav-parent "`
with a trailing space. The `projects` and `careers` links wrap the call
in `trim()`, so they render `class=""` when inactive. Preserve this or
normalise it deliberately; do not let it vary by accident.

### Nav variant map

| `$NAV_ACTIVE` | Pages | Which element gets `is-active` |
|---|---:|---|
| `about` | 4 | About dropdown parent |
| `services` | 7 | Services dropdown parent |
| `industries` | 6 | Industries dropdown parent |
| `projects` | 6 | Projects link (trimmed) |
| `careers` | 1 | Careers link (trimmed) |
| *(unset)* | 4 | Nothing — `index`, `contact`, `terms`, `resources/literature-press` |

**Total: 28 pages.** Any conversion that pastes one fixed header block
into all 28 pages will silently break the active-state highlighting on
24 of them.

---

## 3. Link rewriting

Every internal link points at `.php`. Counts:

| Location | `.php` links | Currently rewritten by build script? |
|---|---:|---|
| Production pages | 136 | Yes |
| `partials/header.php` + `footer.php` | 43 | **No** — partials are never processed |
| **Distinct targets site-wide** | **63** | — |

All header and footer links are absolute (`/about/our-story.php`), which
is good: they resolve identically from any directory depth. The build
script's link regex handles absolute paths correctly — it only skips
`http://`, `https://`, `//`, `mailto:` and `tel:`. The problem is purely
that the partials never reach the regex.

One reference lives outside the HTML: `site/assets/css/styles.css:3015`
mentions `projects/index.php` in a comment. Cosmetic, but update it so
nobody greps for `.php` later and thinks they missed something.

---

## 4. `scripts/build-static.py` — rewritten 2026-09-14

The converter now handles the full include graph. Verified by running it
against `site/` and inspecting the output.

**Does:**
- Renders `partials/header.php` **per page**, evaluating `__gbi_nav_active`
  for the page's `$NAV_ACTIVE` (all 6 variants, §2)
- Inlines `partials/footer.php` with the transitive `feedback-widget.php`
  include and its comment stripped
- Excludes the five review-tooling files and `partials/` / `feedback-data/`
- Rewrites `href`/`src`/`action` to directory-style URLs, in pages *and*
  partials
- Emits directory-style output (`about/our-story/index.html`)
- Emits `staticwebapp.config.json` with cache rules, security headers, and
  a report-only CSP
- **Asserts zero `<?php` or `?>` survives in the output**, exiting non-zero
  if any does

**Verified output:** 28 pages, 523 assets, 8 server-only files skipped.
Header and footer present on 28/28. Nav active-state correct on all six
variants. Zero PHP. The only remaining `.php` string is an external link
to `construction-today.com`, correctly left alone.

### The docblock bug — do not reintroduce

The original script stripped each partial's leading `<?php ... ?>` block
with a non-greedy `^\s*<\?php.*?\?>\s*`. Both partials embed a *usage
example* inside that docblock which itself ends in `?>`:

```php
 *   <?php include $_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php'; ?>
```

So the match stopped at the example and dumped the **rest** of the
docblock into every page as visible text — including, for the header,
the entire `__gbi_nav_active` function definition, rendered right where
the navigation should be.

The fix anchors the closing tag to the start of a line
(`^\?>` with `re.MULTILINE`). The output assertion also checks for `?>`,
not just `<?php`, because a partially-stripped docblock leaks markup
containing the closing tag but not the opening one.

This shipped undetected in the footer for as long as the script has
existed. It is the reason for the assertion in §6 item 6.

---

## 5. Decisions made (2026-09-14)

| Decision | Choice | Consequence |
|---|---|---|
| **URL shape** | Directory-style — `/about/our-story/` | Build emits `our-story/index.html`; all internal links extensionless |
| **Source of truth** | Keep `.php` + partials; build static in CI | A nav change stays a one-file edit in `partials/header.php`. No PHP ever reaches Azure. |
| **Edge / redirect** | Add Azure Front Door **Standard** | Hosts the apex→www 301 and the old→new redirect map. ~$35/mo list, ~$45/mo all-in. |

Two notes on the Front Door decision:

- **It does not change the URL shape.** Internal links must still be
  emitted in final shape by the build, or every internal click costs a
  301 hop. Front Door is for *inbound* legacy URLs, not for papering
  over internal link shape.
- **It does not solve the apex DNS problem.** Front Door still needs the
  apex to resolve to it, and M365 DNS still has no ALIAS record type.
  See §9.

When Front Door is provisioned, lock the origin to it: set
`forwardingGateway.requiredHeaders` in `staticwebapp.config.json` to
require `X-Azure-FDID` matching your Front Door instance. Without that
the `*.azurestaticapps.net` hostname stays publicly reachable and the
WAF can be bypassed by anyone who finds it.

---

## 6. Conversion checklist

### Done

- [x] **1. URL shape decided** — directory-style (§5).
- [x] **2. Header rendered per page.** Six nav variants keyed off
      `$NAV_ACTIVE`, parsed from each page's include line.
- [x] **3. Transitive widget include stripped** from the inlined footer.
- [x] **4. Review tooling excluded** from the build (§1), `tag-review.php`
      included.
- [x] **5. `.php` links inside the partials rewritten** — all 43.
- [x] **6. Zero `<?php` / `?>` asserted in the output.** The build exits
      non-zero if any survives. Caught the docblock bug in §4.
- [x] **7. `.htaccess` rules ported** into `staticwebapp.config.json` —
      one-year immutable caching on `/assets/*`, revalidate on HTML.
- [x] **8. Security headers added** — `X-Content-Type-Options`,
      `X-Frame-Options`, `Referrer-Policy`, HSTS, report-only CSP.
- [x] **9. SPA `navigationFallback` dropped.** It returned **200** for
      every bad URL. Replaced with a real `404` response override.
- [x] **10. `CLAUDE.md` corrected** — see §8.
- [x] **11. 404 page authored.** Every path on it is absolute; Azure serves
      `/404.html` for a missing URL at any depth.
- [x] **12. Prototype markers stripped at build time.** Never visible
      (`display: none !important`), but the text shipped in the HTML
      source — internal photo shot-lists and agency notes. 43 blocks
      across 21 files.
- [x] **13. Every internal URL resolved to an absolute path at build time.**
      Caught in preview: directory-style output moves each page a level
      deeper, so `../assets/css/styles.css` resolved to `/about/assets/...`
      and pages rendered completely unstyled. 504 asset refs, 61 inline
      `url()`, ~110 page links. 534 URLs now verified to resolve.
- [x] **14. Favicon added.** Built from the blue mountain mark — the
      wordmark is illegible at 16px. Every page previously logged a 404
      for `/favicon.ico`.
- [x] **15. SRI added** to the two cdnjs tags, with
      `crossorigin="anonymous"` — SRI is not enforced on a cross-origin
      script without it.
- [x] **16. Images compressed** — 133.6 MB → 98 MB, none corrupted. The
      nine largest were **MPO**, not JPEG, so a naive format check skipped
      exactly the files that mattered; nine "PNGs" were opaque photos,
      11.4 MB that became 1.4 MB. Heroes: 3.5–3.9 MB → 0.6–1.2 MB.
- [x] **17. `canonical`, `sitemap.xml`, `robots.txt`** generated at build
      time from each page's own output path, so they cannot drift.
- [x] **18. Contact form wired** to a Power Automate HTTP-trigger flow,
      with on-screen confirmation, a mailto fallback carrying what the
      user typed, a honeypot, and proper labels. See
      **`FORM-INTEGRATION.md`**.
- [x] **19. Deploy workflow enabled** on push to `main`, with a
      verification gate that fails *before* publishing if raw PHP
      survived, the form endpoint was not injected, review tooling leaked,
      or an expected file is missing. Confirmed green on run
      `34911205673`: 29 pages, 28 sitemap URLs, form endpoint injected.

### Open

- [ ] **20. Build the old → new redirect map.** **Biggest launch risk.**
      `sitemap.xml` says where every page *will* live; nothing says where
      each page *currently* lives. Crawl `mygbi.com` or pull the URL list
      from Search Console, then map old → new in
      `staticwebapp.config.json` or the Front Door rules engine. Without
      it, every ranked page 404s on cutover day.
- [ ] **21. Add `AZURE_STATIC_WEB_APPS_API_TOKEN`.** The only thing
      standing between the current pipeline and a live deploy. Azure
      portal → the Static Web App → Manage deployment token. No file
      edits needed once it exists.
- [ ] **22. Verify the report-only CSP, then enforce it.** Watch the
      browser console on a deployed preview, fix violations, then rename
      the header to `content-security-policy`. Do not enforce untested —
      a wrong CSP breaks the site silently.
- [ ] **23. Lock the origin to Front Door** via
      `forwardingGateway.requiredHeaders` (§5), once Front Door exists.
      Without it the `*.azurestaticapps.net` hostname stays publicly
      reachable and the WAF can be bypassed.
- [ ] **24. Review 17 unreferenced assets (9.8 MB).** **Do not
      bulk-delete**: `logos/gbi.png` and `logos/hti.png` are in that list
      and are deliberately unreferenced. The rest
      (`project-jervois-nyzai.png`, `project-musket-nyzai.png`,
      `project-apache.png`, `staff/joe.png`) need a human decision.
- [ ] **25. Standing constraint: keep `/assets/images/logos/gbi.png` and
      `hti.png` resolving.** Other GBI projects hot-link them as public
      URLs, and the email templates in `email-templates/` depend on them.
      Never prune as "unused assets".

---

## 7. URL change and SEO

Every URL on the site is about to change. There is currently no
`sitemap.xml`, no `robots.txt`, and no `<link rel="canonical">` on any
page.

Before cutover, capture the **live** URL list from the current site
(Google Search Console, or a crawl of `mygbi.com`) and build an
old → new redirect map in `staticwebapp.config.json`. Without it, every
ranked page 404s on launch day.

This matters more than it first appears: `resources/literature-press.php`
carries a note that it replaces an existing
`mygbi.com/gbi-literature-and-press/` page — so the live site's URL
structure does **not** match this rebuild. Assume nothing maps cleanly.

---

## 8. `CLAUDE.md` corrections needed

Two statements are factually wrong and will mislead the next person:

- *"Static HTML/CSS/JS with **one** small PHP include per page (the
  shared footer)."* — There are two direct includes, and a third
  transitively via the footer.
- *"Together those two include lines are the only PHP anywhere on the
  site."* — `partials/header.php` also contains a function definition
  and five `<?php echo ?>` statements; `partials/footer.php` contains a
  third include; five tooling files contain substantial server-side PHP.

---

## 9. DNS and the apex redirect

Target: `https://mygbi.com` → `https://www.mygbi.com`, with `www` as the
canonical host.

Note the target is **https**, not http. Redirecting to http strips TLS,
costs a second hop as the browser upgrades back, and disqualifies the
domain from HSTS preload.

### Why the apex is hard

This is not an M365 limitation — **no** DNS provider can put a `CNAME` at
a zone apex. RFC 1034 forbids a CNAME coexisting with the `SOA` and `NS`
records that must exist there. Providers work around it with proprietary
`ALIAS` / `ANAME` / CNAME-flattening record types. Microsoft 365's
built-in DNS does not offer one. Azure DNS does (alias record sets).

So `www` is the right canonical choice — it is the host that *can* be a
CNAME, which keeps you free to change hosting later without touching A
records.

### Two paths

**Path 1 — check M365 DNS first (lowest risk).** When you add the apex
domain in the Static Web Apps custom-domain blade, Azure shows you the
exact records it wants — typically a `TXT` for validation plus an `A`
record. If the M365 DNS console lets you create both, you are done and
nothing moves. Check this before planning a migration.

**Path 2 — delegate the zone to Azure DNS.** Azure DNS alias record sets
resolve the apex to an Azure resource directly. ~$0.50/zone/month, already
in the cost estimate.

> **Before choosing Path 2, read this.** Moving the zone off M365 means
> recreating **every** Microsoft 365 record by hand. Miss one and company
> email stops — a far worse outage than any website problem. At minimum:
>
> - `MX` → `<tenant>.mail.protection.outlook.com`
> - `TXT` SPF → `v=spf1 include:spf.protection.outlook.com -all`
> - `CNAME` `selector1._domainkey` and `selector2._domainkey` (DKIM)
> - `TXT` `_dmarc`
> - `CNAME` `autodiscover` → `autodiscover.outlook.com`
> - Teams/Skype `SRV` records and `lyncdiscover` / `sip` CNAMEs, if used
> - Any domain-verification `TXT` records
>
> Export the full current zone from the M365 admin center first and
> reconcile it record-for-record after the move.

### The redirect itself

Resolving the apex and *redirecting* it are separate problems. Adding
both `mygbi.com` and `www.mygbi.com` to the same Static Web App makes
both serve the same content with a `200` — duplicate content, not a
redirect.

Check the SWA custom-domain blade for a redirect option when you add the
apex. If there is none, the options are a Front Door rules-engine rule
(adds cost — see the hosting recommendation) or, as a weaker fallback,
`<link rel="canonical">` on every page pointing at the `www` host. That
fallback is listed as item 12 above and is worth doing regardless.

### Cutover sequence

1. Lower TTLs on the records you are about to change to 300s, **at least
   24h ahead**.
2. Stand up the Static Web App and validate on its
   `*.azurestaticapps.net` hostname.
3. Add `www.mygbi.com` as a custom domain — `CNAME` → the SWA hostname.
4. Add the apex, following whichever path above applies.
5. Verify certificates issue for both hosts, then test the redirect.
6. Leave the old host running for a week of clean traffic before
   decommissioning.
7. Restore TTLs.
