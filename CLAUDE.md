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

## Do NOT

- Do not commit `deploy.config` — it contains Cloudways SFTP credentials
  from the pre-migration hosting setup.
- Do not commit built artifacts (`dist/`, `node_modules/`). Both are in
  `.gitignore`.
