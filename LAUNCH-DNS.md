# Launch and DNS runbook

The site is deployed and verified. This covers the domain work.

Audited against live DNS on 2026-09-15.

---

## 1. Where things stand

| | Status |
|---|---|
| Static Web App | **Live** — `mygbi-home`, at `https://polite-forest-0d5b1771e.3.azurestaticapps.net` |
| Deploy pipeline | Green on push to `main`, with a pre-publish verification gate |
| Security headers, caching, sitemap, robots, 404 | Verified live |
| Contact form | **Blocked** — flow trigger requires OAuth. See `FORM-INTEGRATION.md` §4b |
| Enterprise Grade Edge | Enabling in progress — **$17.52/app/month** |
| `www.mygbi.com` | Validating. Ownership TXT **published** |
| `mygbi.com` (apex) | Validating. Ownership TXT **published**. Needs the routing record |
| Separate Front Door profile | **Not needed** — EGE is Front Door |

### Verified in DNS on 2026-09-15

Both ownership tokens are already live, so validation should complete on
its own:

| Name | Type | Value |
|---|---|---|
| `www.mygbi.com` | TXT | `_ddp7r1l36bmmpr31prg07s7fklek8sr` |
| `mygbi.com` | TXT | `_qcks35aejgrv1t1ezy67haozs8h4dda` |

**What is still missing is the routing.** Ownership TXT records prove the
domain is yours; they send no traffic. Neither host resolves to the site
yet:

| Name | Type | Current |
|---|---|---|
| `www.mygbi.com` | CNAME | **absent** — needs `polite-forest-0d5b1771e.3.azurestaticapps.net` |
| `mygbi.com` | A | **absent** — needs the value from the portal's *Add a CNAME, ALIAS or A record* link |

---

## 2. The apex — resolved, and no DNS migration needed

> "Front Door would provide me an IP that I could point my A record to."

**This was closer to right than an earlier draft of this document allowed
for.** The Custom domains blade offers, for the apex, *"Add a CNAME, ALIAS
or A record"* — so Static Web Apps does support an **A record** at the
apex, and the portal supplies the value.

That settles the question and removes the biggest risk in this migration:

- **The zone stays in Microsoft 365.** M365 DNS can create an A record and
  a TXT record, which is all that is required.
- **No Exchange Online / Duo / Sophos record migration.** The inventory in
  §3 stays exactly where it is. Nothing to recreate, nothing to break.
- **No Azure DNS zone**, and no separate Front Door profile.

The general caution still holds for a *standalone* Front Door profile:
that serves from shared anycast addresses and is pointed at with an Azure
DNS alias record, not a hardcoded IP. It simply does not apply here,
because the Static Web App's own apex support is doing the work.

Take the value from the portal link rather than from a DNS lookup of the
app's default hostname. They may differ, and the portal's is the supported
one.

This is not an Azure quirk. **No DNS provider can put a `CNAME` at a zone
apex** — RFC 1034 forbids it coexisting with the `SOA` and `NS` records
that must live there. Providers work around it with proprietary `ALIAS` /
`ANAME` / CNAME-flattening types. Microsoft 365's DNS has none of them.

---

## 3. What the live zone actually contains

`mygbi.com` is hosted on **Microsoft 365 DNS** (`ns1-4.bdm.microsoftonline.com`).

### Two findings that change the plan

**There is no website at `mygbi.com` today.** The apex has **no `A` record**
and `www.mygbi.com` does **not exist** (`NXDOMAIN`). Nothing resolves.

That is good news and worth confirming before launch, because it means:

- There is no live site to take down, so cutover carries no downtime risk.
- The old → new redirect map may be unnecessary. That was flagged as the
  single biggest launch risk; if nothing is currently indexed at
  `mygbi.com`, it largely evaporates. **Confirm in Search Console before
  assuming this.**
- The logo URLs in the email templates
  (`https://mygbi.com/wp-content/uploads/2026/08/gbi.png`) are **already
  broken**, not "will break at cutover". Any existing flow using them is
  sending mail with missing images right now.

**You already run a Static Web App on this domain.**
`portal.mygbi.com` → `black-beach-0713c821e.3.azurestaticapps.net`.

So the `www` half is already proven: M365 DNS can host a `CNAME` pointing
at a Static Web App, and you have done it before. Only the apex is in
question.

### Records that must survive any DNS move

Email and identity depend on these. Losing one breaks mail flow, SSO or
device enrolment — far worse than a website outage.

| Name | Type | Value |
|---|---|---|
| `mygbi.com` | MX 10 | `mx-01-us-east-2.prod.hydra.sophos.com` |
| `mygbi.com` | MX 20 | `mx-02-us-east-2.prod.hydra.sophos.com` |
| `mygbi.com` | TXT | `v=spf1 include:spf.mygbi.com include:_spf_uswest2.prod.hydra.sophos.com ~all` |
| `spf.mygbi.com` | TXT | `v=spf1 include:spf.protection.outlook.com -all` |
| `selector1._domainkey` | CNAME | `selector1-mygbi-com._domainkey.mygbi.onmicrosoft.com` |
| `selector2._domainkey` | CNAME | `selector2-mygbi-com._domainkey.mygbi.onmicrosoft.com` |
| `_dmarc` | TXT | `v=DMARC1; p=quarantine; pct=100; adkim=r; aspf=r; rua=mailto:dmarc@mygbi.com` |
| `enterpriseregistration` | CNAME | `enterpriseregistration.windows.net` |
| `enterpriseenrollment` | CNAME | `enterpriseenrollment-s.manage.microsoft.com` |
| `vpn` | A | `166.70.205.26` |
| `ftp` | A | `166.70.205.26` |
| `portal` | CNAME | `black-beach-0713c821e.3.azurestaticapps.net` |

Plus **twelve apex `TXT` records**, several of which are live integrations
rather than dead verification strings: Microsoft (`mscid=`), Sophos (two),
**Duo SSO**, Apple, Adobe, OpenAI, Anthropic, and three opaque values.
Mail routes through **Sophos**, not straight to Exchange Online, so the
Sophos records are load-bearing.

> Note that mail is Sophos-fronted and SSO is Duo. A botched zone move
> takes out email *and* sign-in at the same time.

---

## 3a. Enterprise Grade Edge is on — use TXT validation

Adding `www` with **CNAME** validation fails:

> CNAME Validation for a custom domain is not allowed when Enterprise
> Grade Edge is enabled or enabling. Please use TXT token validation.

**Enterprise Grade Edge is Azure Front Door, built into Static Web Apps.**
It is the "enterprise-grade edge" option on the SWA, and it is why the
CNAME path is refused: with Front Door fronting the app, the CNAME-based
ownership proof no longer works, so Azure requires a TXT token instead.

A probe of the live site on 2026-09-15 returned no `x-azure-ref` or other
Front Door headers, which matches the error's "enabled **or enabling**" —
provisioning is still in flight. Give it time to finish before judging any
edge behaviour.

### The fix

In the **Validate + add** step, change **Hostname record type** from
`CNAME` to **`TXT`**. Then:

1. Azure shows a TXT record — host is typically `_dnsauth.www`, value is a
   one-time token.
2. Create it in the M365 DNS admin centre.
3. Wait for Azure to validate. This is ownership proof only; it routes no
   traffic.
4. Once validated, add the record that actually routes traffic:
   `www` → `CNAME` → `polite-forest-0d5b1771e.3.azurestaticapps.net`.
5. Repeat for the apex, and note which record type it asks for.

The two steps are separate on purpose. TXT proves ownership without
touching live traffic, which is what the dialog means by "set up the domain
now and migrate the site later". Nothing is live at `mygbi.com` (§3), so
there is no traffic to protect here — but EGE requires TXT regardless.

### This changes the Front Door decision

The earlier plan budgeted a **separate** Front Door Standard profile at
roughly $540/year, to get apex support and the apex → www redirect. With
Enterprise Grade Edge already on the Static Web App, Front Door is
*already* in front of the site, so a second profile would be Front Door
behind Front Door.

Before provisioning anything more, check what EGE gives you:

| Want | Likely covered by EGE? |
|---|---|
| Apex domain support | Yes — this is a main reason it exists |
| Global edge caching, DDoS | Yes |
| WAF policy | Check — EGE exposes a limited surface |
| Apex → www `301` | **Probably not** — the managed Front Door does not give you rules-engine access |

If the `301` turns out to be unavailable, the fallback is already in place:
every page carries `<link rel="canonical" href="https://www.mygbi.com/...">`,
which is what search engines use to pick the canonical host. Given nothing
is currently indexed at `mygbi.com` (§3), that is a reasonable place to
land rather than paying for a second Front Door to get a redirect.

---

## 3b. Logo URLs for other flows and forms

Anything in the tenant using the GBI/HTI email wrapper points at
WordPress paths that are **already dead** — confirmed 2026-09-15, the old
host does not resolve. Those emails are sending broken images right now.

| | |
|---|---|
| Old, dead | `https://mygbi.com/wp-content/uploads/2026/08/gbi.png` |
| Old, dead | `https://mygbi.com/wp-content/uploads/2026/08/hti.png` |
| **New** | `https://www.mygbi.com/assets/images/logos/gbi.png` |
| **New** | `https://www.mygbi.com/assets/images/logos/hti.png` |

Both new paths are deployed and serving `image/png` with one-year
immutable caching. They are byte-identical to the originals at 639x300 and
640x300, so the wrapper's `width="136" height="64"` still fits.

### Which host to use

The new URLs resolve only once `www.mygbi.com` has its routing CNAME
(§1). Until then they 404 — same as the WordPress paths they replace.

**Use the `www.mygbi.com` form anyway.** The logos are already broken in
production, so nothing regresses by waiting for DNS, and it avoids editing
every flow twice. If a specific flow needs working images before DNS is
finished, the app's default hostname works today:

```
https://polite-forest-0d5b1771e.3.azurestaticapps.net/assets/images/logos/gbi.png
```

Treat that as temporary — it is the deployment hostname, not a brand
address, and it should not outlive the cutover.

### Do not prune these files

`site/assets/images/logos/gbi.png` and `hti.png` are referenced by no page
on the site, so any "unused asset" sweep will flag them. They exist for
exactly this purpose. See checklist item 25 in `STATIC-CONVERSION.md`.

---

## 4. Two paths for the apex

### Path A — try the Static Web App first (recommended, zero risk)

Azure Static Web Apps supports apex domains. When you add one, the portal
shows you the **exact records it wants** — that is the authoritative answer,
not anything written here.

1. SWA → **Custom domains** → **Add** → `www.mygbi.com`. It will ask for a
   `CNAME` to the app's default hostname. You have done this for
   `portal.mygbi.com`, so it will work.
2. SWA → **Custom domains** → **Add** → `mygbi.com` (apex). **Read what
   the portal asks for.**
   - If it wants a `TXT` for validation plus an `A` record with an address
     it supplies → M365 DNS can create both. **You are done. No DNS
     migration, no Front Door needed for the domain.**
   - If it only offers an `ALIAS` record → M365 DNS cannot do it, and you
     need Path B.

Do this before planning anything larger. It costs nothing, it is
reversible, and it settles the question definitively.

**What Path A does not give you** is a `301` from apex to `www`. Both hosts
would serve the same content. Every page already carries
`<link rel="canonical" href="https://www.mygbi.com/...">`, which is what
search engines use to pick a winner, so this is acceptable — just not as
clean as a real redirect.

### Path B — delegate the zone to Azure DNS

Needed if Path A cannot do the apex, or when you want the real apex → www
`301` and the Front Door WAF.

1. Create the Azure DNS zone for `mygbi.com`.
2. **Recreate every record in §3 first**, while M365 is still authoritative.
   Nothing is live yet — this is just staging the zone.
3. Verify by querying the Azure DNS nameservers directly before delegating:
   ```bash
   dig @<azure-ns1> mygbi.com MX +short
   dig @<azure-ns1> mygbi.com TXT +short
   dig @<azure-ns1> selector1._domainkey.mygbi.com CNAME +short
   ```
   Compare against §3 record for record. Do not delegate until they match.
4. Only then change the nameservers at the registrar.
5. Add the apex as an Azure DNS **alias record** (A type) targeting the
   Front Door profile, and `www` as a `CNAME` to `<profile>.azurefd.net`.
6. Front Door **rules engine**: match `Host` = `mygbi.com`, action **URL
   redirect** → `https://www.mygbi.com`, preserve path and query, `301`.

**Lower TTLs to 300s at least 24 hours before** the nameserver change, and
restore them a week after.

---

## 5. Recommended order

1. **Fix the contact form trigger** (`FORM-INTEGRATION.md` §4b) and update
   the `GBI_FORM_ENDPOINT` secret. Independent of DNS; do it now.
2. **Add `www.mygbi.com`** to the SWA. Proven pattern, low risk. The site
   is then reachable on a real domain.
3. **Try the apex in the SWA blade** and see which record it asks for (§4,
   Path A). This is the decision point.
4. **Confirm in Search Console** whether anything is actually indexed at
   `mygbi.com`. If nothing is, skip the redirect map entirely.
5. **Verify the CSP** on the live domain, then switch it from report-only
   to enforcing.
6. **Front Door**, only if you want the apex `301`, the WAF, or both. If
   you add it, lock the origin with `forwardingGateway.requiredHeaders`
   (`X-Azure-FDID`) so the `*.azurestaticapps.net` hostname cannot be used
   to bypass it.

---

## 6. What to send back

To go further I need:

- Which record the SWA custom-domain blade asks for on the **apex** — a
  screenshot of that step answers it.
- Whether Search Console shows indexed URLs for `mygbi.com`.
- Whether the registrar for `mygbi.com` is inside the M365 admin centre or
  at an external registrar, since that determines who changes the
  nameservers in Path B.
