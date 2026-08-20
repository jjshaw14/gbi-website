# CLAUDE.md — Repo instructions for Claude agents

## What this repo is

The Great Basin Industrial (GBI) marketing site at `mygbi.com`. Static
HTML/CSS/JS with **one** small PHP include per page (the shared footer).
No database, no framework, no build step in production.

## Structure

```
site/                        ← the deployable web root
├── index.php                ← homepage
├── about/ services/ industries/ projects/ resources/
├── partials/footer.php      ← shared footer (server-side include)
├── assets/                  ← CSS, JS, images, staff photos, logos
├── careers.php contact.php terms.php
└── .htaccess                ← Apache directives (App Service path only)

.github/workflows/           ← GitHub Actions deploy pipelines
scripts/build-static.py      ← PHP → HTML converter (Static Web Apps path)
AZURE_SETUP.md               ← full Azure migration guide
```

## The one PHP thing

Every `.php` page includes the shared footer via a single line at the
bottom:

```php
<?php include $_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php'; ?>
```

That's the *only* PHP anywhere on the site. If you edit
`partials/footer.php`, the change appears on every page automatically.

## Making edits

- **Content, layout, styling**: edit files in `site/` directly.
- **Global styles**: `site/assets/css/styles.css`
- **Client-side JS**: `site/assets/js/site.js`
- **Shared footer**: `site/partials/footer.php`

## Deploying

Deploys run automatically on `git push origin main` via GitHub Actions.
See `.github/workflows/` for the pipeline definitions and `AZURE_SETUP.md`
for the full setup story.

## Conventions worth knowing

- **Internal links use `.php`** (e.g. `href="/about/our-story.php"`). On
  the Azure App Service path these resolve directly; on the Static Web
  Apps path the build script rewrites them to `.html` at deploy time.
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
