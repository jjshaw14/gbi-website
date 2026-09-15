# Launch and DNS runbook

The site is deployed and verified. This covers the domain work.

Audited against live DNS on 2026-09-15.

---

## 1. Where things stand

| | Status |
|---|---|
| Static Web App | **Live** at `https://polite-forest-0d5b1771e.3.azurestaticapps.net` |
| Deploy pipeline | Green on push to `main`, with a pre-publish verification gate |
| Security headers, caching, sitemap, robots, 404 | Verified live |
| Contact form | **Blocked** — flow trigger requires OAuth. See `FORM-INTEGRATION.md` §4b |
| Custom domain | Not configured |
| Front Door | Not created |

---

## 2. Correcting the Front Door assumption

> "Front Door would provide me an IP that I could point my A record to."

That is not how Front Door works, and building the plan around it would
lead somewhere frustrating.

Front Door serves from **anycast IP addresses shared across the platform**.
Microsoft does not assign your profile a stable IP and does not support
you hardcoding one into an A record — the address you would see today can
change, and the site would go dark when it does.

The supported way to point an apex at Front Door is an **Azure DNS alias
record**: an `A`-type record set whose target is the Front Door *resource*
rather than an address. Azure DNS resolves it dynamically. That requires
the zone to be hosted in Azure DNS.

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
