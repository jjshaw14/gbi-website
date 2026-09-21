# CLAUDE.md — Repo instructions for Claude agents

## What this repo is

The Great Basin Industrial (GBI) marketing site at `mygbi.com`. Static
HTML/CSS/JS with **two** small PHP includes per page (a shared header
and footer), plus a third that reaches every page transitively via the
footer. No database, no framework, no build step in production.

**Converting to static HTML?** Read `STATIC-CONVERSION.md` first. The
include structure is deeper than it looks and the pieces that break are
invisible until they reach production.

## Structure

```
site/                        ← the deployable web root
├── index.php                ← homepage
├── about/ services/ industries/ projects/ resources/
├── partials/header.php      ← shared header + nav (server-side include)
├── partials/footer.php      ← shared footer (server-side include)
├── assets/                  ← CSS, JS, images, staff photos, logos
├── careers.php contact.php terms.php
└── .htaccess                ← Apache directives (App Service path only)

.github/workflows/           ← GitHub Actions deploy pipelines
scripts/build-static.py      ← PHP → HTML converter (Static Web Apps path)
AZURE_SETUP.md               ← full Azure migration guide
STATIC-CONVERSION.md         ← include map + static conversion checklist
FORM-INTEGRATION.md          ← contact form → Power Automate contract
LAUNCH-DNS.md                ← domain/DNS runbook + live zone inventory
```

## The shared partials

Every `.php` page includes two shared partials — the header at the top
and the footer at the bottom.

Those two include lines are the only PHP **written on the pages
themselves**, but they are not the only PHP on the site:

- `partials/header.php` defines a function (`__gbi_nav_active`) and
  calls it at five places, so the header renders differently on every
  page depending on `$NAV_ACTIVE`. It is not a fixed block of HTML.
- `partials/footer.php` ends with a third include pulling in
  `feedback-widget.php`, which therefore reaches all 28 production
  pages even though no page references it. **Review tooling — it must
  not ship to production.**
- Five files carry real server-side logic (`$_POST`, `$_FILES`, disk
  writes): `feedback.php`, `fb-board.php`, `feedback-widget.php`,
  `feedback-test.php`, `tag-review.php`. All are pre-launch scaffolding.

`STATIC-CONVERSION.md` maps this in full.

**Header (top of every page):**

```php
<?php $NAV_ACTIVE = 'about'; // 'about' | 'services' | 'industries' | 'projects' | 'careers'
      include $_SERVER['DOCUMENT_ROOT'] . '/partials/header.php'; ?>
```

`$NAV_ACTIVE` marks which top-level nav item gets the `is-active` class.
Homepage, contact, terms, and resources/literature-press don't set it —
those pages don't correspond to a single top-level nav item, and the
bare `<?php include … ?>` line is fine.

**Footer (bottom of every page):**

```php
<?php include $_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php'; ?>
```

Edit `partials/header.php` or `partials/footer.php` once and the change
propagates to every page.

## Making edits

- **Content, layout, styling**: edit files in `site/` directly.
- **Global styles**: `site/assets/css/styles.css`
- **Client-side JS**: `site/assets/js/site.js`
- **Shared header / nav**: `site/partials/header.php`
- **Shared footer**: `site/partials/footer.php`

## Deploying

Deploys run automatically on `git push origin main` via GitHub Actions.
See `.github/workflows/` for the pipeline definitions and `AZURE_SETUP.md`
for the full setup story.

## Conventions worth knowing

- **Internal links use `.php`** (e.g. `href="/about/our-story.php"`), and
  may be relative. The build script resolves every internal URL to an
  absolute, directory-style path at deploy time —
  `/about/our-story.php` becomes `/about/our-story/`. Do not hand-write
  directory-style links in `site/`; the source stays `.php`.
- **Every page has an `.hero-sm` header block** with a background image
  and a dark gradient overlay for text contrast. See any page in
  `site/about/` for the pattern.
- **Icons in service/industry tiles** are inline SVGs, not image files.
- **Case study pages** live in `site/projects/` — each is a self-contained
  `.php` file with narrative + "By the Numbers" aside + scope list +
  image gallery.
- **Photo folders under `assets/images/`**: `staff/` for leadership
  portraits, `quality/` for compliance logos, `logos/` for GBI-CHECK/
  GBI-SHARE brand logos and partner logos, `case-studies/` for gallery
  images, `gallery/` for the Projects page grid.

## Removed content and how to restore it

### Advanced Facilities / Instrumentation & Electrical gallery images

**Removed 2026-09-21 in commit `0d7a2ad`** — 14 images published without
final approval. Removed from the live site at the client's request.

If approval later comes through, this is fully reversible. Everything —
image bytes, tile markup, tags, `alt` text and overlay captions — is in
git at `0d7a2ad^`.

**The files** (`site/assets/images/gallery/`):

```
gbi-electrical-advancedfacilities-001.jpg … -014.jpg
```

Sequential, `-001` through `-014`. Original sources are in
`OneDrive_2026-09-02/GBI_Electrical_AdvancedFacilities_001…_014`
(`.png`, except `_008` which is `.jpg`) — in the repo but never deployed,
since that folder sits outside `site/`.

**To restore all 14:**

```bash
git revert 0d7a2ad && git push origin main
```

One commit brings back the image files, all 14 gallery tiles with their
`data-industry="advanced-facilities" data-product="ie"` tags and captions,
*and* resets the gallery total from 279 to 293. Push deploys it.

**To restore only some**, do **not** revert — that returns all 14. Pull the
specific files and tiles out of the parent commit instead:

```bash
# one file
git checkout 0d7a2ad^ -- site/assets/images/gallery/gbi-electrical-advancedfacilities-003.jpg

# see the tile markup to paste back into site/projects/index.php
git show 0d7a2ad^:site/projects/index.php | grep 'data-product="ie"'
```

Then adjust the hardcoded total in `site/projects/index.php` by however
many were restored (see the caveat below).

### Things that will trip you up

- **The tiles must come back with the files.** Restoring images alone
  leaves them invisible; restoring tiles alone leaves 14 broken
  thumbnails. They are removed and restored together.
- **A plain `git revert` only stays conflict-free while nothing else edits
  `site/projects/index.php`.** If the gallery has been touched since, git
  will ask you to resolve that file. It is a small manual merge, not a
  reconstruction — the tiles are one contiguous 14-line block.
- **Four other `advancedfacilities` images were deliberately NOT removed**
  and are still live. They are different product categories, not part of
  the unapproved set:
  `gbi-smp-advancedfacilities-001…003` (SMP) and
  `gbi-tank-advancedfacilities-001` (Tank).
- **The gallery total is hardcoded and was already wrong.**
  `site/projects/index.php` carries the count in two places (a comment and
  the `of N images` text next to `<span class="js-count">`). It read 293
  against 384 actual tiles *before* this removal, and was decremented to
  279 to stay self-consistent rather than rebased. The `js-count` span
  itself is overwritten by script on load; only the static total is
  authored. If you correct that number properly, do it as its own change.

## Do NOT

- Do not commit `deploy.config` — it contains Cloudways SFTP credentials
  from the pre-migration hosting setup.
- Do not commit built artifacts (`dist/`, `node_modules/`). Both are in
  `.gitignore`.
