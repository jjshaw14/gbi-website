# Azure Migration Setup Guide

**For the GBI IT/security team.** This guide is written to be actionable
either by a human admin or by a Claude agent working alongside one.

The GBI marketing site (`mygbi.com`) is being migrated off Cloudways
(DigitalOcean) onto Azure. Two hosting options are supported: **App
Service (Path A)** or **Static Web Apps (Path B)**. Pick one based on
governance/cost, then follow that section end-to-end.

---

## Repository contents

```
.
├── AZURE_SETUP.md                  ← this file
├── HANDOFF.md                      ← executive summary of the migration
├── .github/workflows/
│   ├── deploy-app-service.yml      ← Path A workflow
│   └── deploy-static-web-app.yml   ← Path B workflow
├── scripts/
│   └── build-static.py             ← Path B build script (PHP → static HTML)
├── site/                           ← the deployable website root
│   ├── index.php
│   ├── about/ services/ industries/ projects/ resources/
│   ├── partials/footer.php         ← shared footer (server-side include)
│   ├── assets/                     ← CSS, JS, images, staff photos, logos
│   ├── careers.php contact.php terms.php
│   └── .htaccess                   ← Apache directives (Path A only)
├── deploy.sh                       ← old Cloudways SFTP script (retired)
└── deploy.config.example           ← old config template (retired)
```

**About the site architecture.** Every page is a `.php` file, but PHP is
used for exactly one thing: a single one-line include at the bottom of
each page that pulls in `partials/footer.php`. Everything else is static
HTML, CSS, and vanilla JavaScript. No database, no framework, no build
step in production.

---

## Path A — Azure App Service with PHP (recommended)

The site runs as-is. No conversion, no build.

### A1. Provision the App Service

- Create an **Azure App Service** (Web App resource).
- Runtime stack: **PHP 8.2** (or newer) on **Linux**.
- Region: closest to primary audience (e.g., West US 2).
- Pricing tier: **B1** or **S1** is plenty for this low-traffic site.
- Note the App Service name — it forms the default URL:
  `https://<name>.azurewebsites.net`.

### A2. Wire up the GitHub deploy

1. In the Azure Portal, open the App Service → **Deployment Center** →
   **Manage publish profile** → **Download publish profile**. You'll get
   a small XML file.
2. In this GitHub repo: **Settings → Secrets and variables → Actions →
   New repository secret**. Name it exactly:
   ```
   AZURE_WEBAPP_PUBLISH_PROFILE
   ```
   Value: paste the full contents of the publish profile XML file.
3. Open `.github/workflows/deploy-app-service.yml` and change
   `AZURE_WEBAPP_NAME` to match your App Service name.
4. Commit and push. Alternatively, trigger the first deploy manually:
   **Actions tab → Deploy to Azure App Service → Run workflow**.
5. Delete `.github/workflows/deploy-static-web-app.yml` if you're
   committed to Path A (optional — it only runs on manual dispatch, so
   it will not fire automatically).

### A3. First-run checks

- Visit `https://<name>.azurewebsites.net`. The homepage should load
  with a fully rendered footer. If the footer is missing or you see
  literal `<?php ... ?>` text on the page, PHP handling is not active —
  double-check the runtime stack.
- Click into `/about/our-story.php`, `/services/tanks-plate-steel.php`,
  and `/projects/index.php`. All should load, and the Projects page
  should show the animated 2007–2026 map at the bottom of the gallery.

### A4. Custom domain + SSL

1. App Service → **Custom domains → Add custom domain**.
2. Add both `mygbi.com` (apex/root) and `www.mygbi.com`.
3. Follow Azure's DNS validation prompts. Azure issues free managed
   SSL certificates for validated domains.
4. Lower the current DNS TTL on `mygbi.com` records 24 hours before
   cutover, then flip the A/CNAME records to point at Azure.

### A5. Static file handling

- The included `site/.htaccess` handles gzip, cache headers, and the
  `DirectoryIndex index.php index.html index.htm` order. Linux App
  Service honors `.htaccess` by default.
- If any directive doesn't take effect, an equivalent can be set under
  **Configuration → Application settings** or via a custom `startup.sh`.

---

## Path B — Azure Static Web Apps (fallback, static only)

Use this **only** if App Service is off the table. SWA does not run
PHP, so we build a static version of the site with a small Python
script.

### B1. What the build does

`scripts/build-static.py` reads the source `site/` folder and outputs
a `dist/` folder in which:

- Every `.php` file becomes `.html`.
- The one-line footer include is replaced with the actual footer HTML.
- Internal links pointing at `.php` files are rewritten to `.html`.
- External URLs (including ones like `construction-today.com/index.php`)
  are left untouched.
- `.htaccess` is dropped and replaced with `staticwebapp.config.json`
  for SWA-native routing and cache headers.
- The `partials/` folder is not copied (server-only).

You can test the build locally at any time:

```bash
python scripts/build-static.py site dist
```

### B2. Provision the SWA

1. In the Azure Portal, create a **Static Web App**.
2. When prompted for source, connect it to this GitHub repo. Azure will
   offer to auto-generate a workflow file — **skip that**; we already
   provide one at `.github/workflows/deploy-static-web-app.yml`.
3. Azure creates a secret in this repo automatically, named something
   like `AZURE_STATIC_WEB_APPS_API_TOKEN_<RANDOM>`. Copy the exact name
   from **Settings → Secrets and variables → Actions**.
4. Edit `.github/workflows/deploy-static-web-app.yml`:
   - Change `${{ secrets.AZURE_STATIC_WEB_APPS_API_TOKEN }}` to the exact
     secret name Azure created.
   - Uncomment the `push: branches: [main]` trigger.
5. Commit and push. The workflow will build and deploy.
6. Delete `.github/workflows/deploy-app-service.yml` (optional).

### B3. Custom domain + SSL

Same idea as Path A but through SWA's **Custom domains** panel. SWA
also issues free managed SSL.

---

## Common tasks after cutover

### Deploying an edit

Both paths use GitHub Actions on push to `main`. Workflow:

1. Edit files in the repo (via `git`, or an editor with git integration).
2. Commit and push to `main`.
3. GitHub Actions runs; deploy completes in ~1–2 minutes.
4. Refresh the browser to verify.

### Rolling back

`git revert <bad-commit-sha> && git push`. Actions redeploys the
previous state.

### Editing the footer

Edit `site/partials/footer.php`. On Path A this is picked up automatically.
On Path B, the next push runs the build script and re-inlines it across
all pages — no per-page changes required.

### Adding a new page

- Path A: drop a new `.php` file in the appropriate folder. Include the
  footer at the bottom using the same one-liner as other pages.
- Path B: same — the build script handles it automatically on next deploy.

### Editing internal links

Always link to `.php` in the source. On Path A they resolve directly.
On Path B the build script rewrites them to `.html` at build time.

---

## Pre-launch cleanup — REMOVE BEFORE GOING LIVE

The following review-phase tools are living in the repo during the
draft-site feedback window. They must be removed before the site goes
live on Azure — none of them are meant for the public site.

**1a. Bradford's gallery tag review page**
- Delete: `site/tag-review.php`
- One file, no side effects. Verify `/tag-review.php` returns a 404
  after removal.

**1b. JJ's gallery duplicate review page**
- Delete: `site/dupe-review.php`
- One file, no side effects. Verify `/dupe-review.php` returns a 404
  after removal.

**2. Feedback board (from client's IT team)**
- Delete: `site/feedback.php`
- Delete: `site/feedback-widget.php`
- Delete: `site/feedback-data/` (JSON store + uploaded screenshots)
- Remove the `<?php include dirname(__DIR__) . '/feedback-widget.php'; ?>`
  line from `site/partials/footer.php` (the block right after the site.js
  script tag, marked with the `REVIEW PHASE ONLY` comment).
- Verify the floating "💬 Feedback" button no longer appears on any page.

**3. Old Cloudways deploy artifacts (already gitignored, but worth
checking on the Azure host):**
- `deploy.config`, `deploy.sh`, `deploy-watch.sh` should never have
  been uploaded to Azure. If they got there via a mistake, delete them.

After all three removals, `git status` on the contractor machine should
show a clean set of deletions ready to commit as the pre-launch cleanup.

---

## After the DNS cutover

- Confirm SSL is active on `https://mygbi.com` and `https://www.mygbi.com`.
- Ask GBI's SOC/security contacts to re-run their scanners against the
  new Azure IP. Some SOC tools cache the *domain* → *reputation* mapping
  rather than the IP; if any flags persist after 48–72 hours, submit
  removal requests to the specific SOC tools (Cisco Talos, Palo Alto
  URL Filtering, Proofpoint URL Defense, etc.). Have the fresh Azure
  IP and the domain history ready.
- The Cloudways/DigitalOcean environment can be decommissioned once DNS
  has fully propagated and the site is verified live on Azure.

---

## Things that are NOT in this repo

Excluded from version control (via `.gitignore`) to keep the repo clean
and secure:

- `deploy.config` — contains SFTP credentials for the old Cloudways
  host. Not needed on Azure.
- `_archive/`, `content-handoff/`, `photos-raw/`, `elementor-kit/` —
  source material handed to the contractor. Not part of the live site.
- Original client PDF briefs.
- `.DS_Store` and other OS junk.

If any of these are needed for reference during the migration, they
still exist on the original contractor's machine.

---

## Questions?

- Anything about the site's content, structure, or where a particular
  section lives → ask the contractor.
- Anything about Azure provisioning or the GitHub Actions workflows →
  work through the checklists above. If a workflow fails, the run log
  in the Actions tab shows exactly which step broke and why.
- If PHP rendering on App Service produces literal `<?php ?>` in the
  page source, the runtime stack setting is wrong — it should say PHP
  8.x, not "static content only".
