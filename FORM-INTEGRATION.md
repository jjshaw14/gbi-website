# Contact form → Power Automate

The project-inquiry form on `/contact/` posts to a Power Automate
HTTP-trigger flow. This is the contract between the page and the flow.

The page side is built and tested. What remains is the flow itself and
one GitHub secret.

---

## 1. What the page sends

A single `POST` with a JSON string body:

```json
{
  "firstName": "Dale",
  "lastName": "Hutchins",
  "company": "Kiewit",
  "jobTitle": "Project Manager",
  "phone": "801-555-0142",
  "email": "dale@example.com",
  "projectLocation": "Elko, NV",
  "projectType": "Tank",
  "projectDescription": "Two API 650 tanks, 60ft diameter...",
  "referralSource": "Referral from Barrick",
  "submittedAt": "2026-09-14T23:01:02.561Z",
  "sourcePage": "https://www.mygbi.com/contact/"
}
```

`projectType` is one of: `Tank`, `SMP`, `I&E`, `Railroad`, `Coatings`,
`GC`, `Not Sure`. Required fields are `firstName`, `lastName`, `email`
and `projectDescription` — the browser enforces those before the POST.

Empty optional fields arrive as empty strings, not `null`.

The honeypot field (`companyWebsite`) is **never** sent. A submission
with it filled is dropped in the browser, as is one submitted within 3
seconds of page load. Bots see no difference either way.

---

## 2. The CORS constraint — read this before building the flow

The request is sent with `Content-Type: text/plain;charset=UTF-8`, **not**
`application/json`. This is deliberate and load-bearing.

`application/json` makes the request "non-simple" under CORS, so the
browser first sends a preflight `OPTIONS` call. **Power Automate HTTP
triggers do not answer `OPTIONS`**, so the preflight fails and the real
POST never happens. `text/plain` is a CORS simple request, which skips
preflight entirely.

The body is still JSON — just delivered under a content type the browser
will send without asking permission first.

Two consequences for the flow:

1. **Parse the body explicitly.** With `text/plain`, `triggerBody()` is a
   string, not an object. Use a **Parse JSON** action with Content set to
   `triggerBody()` and the schema in §3.
2. **Return the CORS header.** Add a **Response** action with
   `Access-Control-Allow-Origin: https://www.mygbi.com`. Without it the
   browser blocks the page from reading the reply, the page treats the
   send as failed, and the submitter sees the mailto fallback even though
   the flow ran. That failure mode is confusing precisely because the
   email still arrives.

---

## 3. Parse JSON schema

```json
{
  "type": "object",
  "properties": {
    "firstName":          { "type": "string" },
    "lastName":           { "type": "string" },
    "company":            { "type": "string" },
    "jobTitle":           { "type": "string" },
    "phone":              { "type": "string" },
    "email":              { "type": "string" },
    "projectLocation":    { "type": "string" },
    "projectType":        { "type": "string" },
    "projectDescription": { "type": "string" },
    "referralSource":     { "type": "string" },
    "submittedAt":        { "type": "string" },
    "sourcePage":         { "type": "string" }
  }
}
```

---

## 4. Suggested flow shape

```
When an HTTP request is received        (premium trigger)
  └─ Parse JSON                          Content: triggerBody()
      └─ Condition: email is not empty   (cheap sanity gate)
          ├─ Send an email (V2)          → sales@mygbi.com
          │     Subject: Project Inquiry — {company} — {projectType}
          │     Reply-To: {email}          ← makes replying one click
          ├─ Send an email (V2)          → {email}   (autoreply)
          ├─ Add a row / Create item     → Excel or a SharePoint list
          └─ Post a message              → Teams channel  (optional)
  └─ Response                            200, with the CORS header
```

Two details worth getting right:

- **Set `Reply-To` to the submitter's address** on the internal email.
  Without it, hitting Reply answers the service account and the lead
  never hears back.
- **Send to a monitored mailbox, not a person.** `sales@mygbi.com`
  already exists and is the published address for bidding and project
  inquiries. A personal inbox means inquiries stall when someone is on
  site or on leave.

### Put the Response action last, but make it unconditional

If the flow errors before the Response action, the page gets no reply and
shows the fallback. Configure the Response to run regardless — otherwise
a transient failure in, say, the SharePoint step makes a successful email
look like a failure to the submitter.

---

## 5. Wiring the endpoint into the build

The flow URL carries a SAS signature in `?sig=`, so it is **not committed
to the repo**. It is injected at build time.

1. Copy the HTTP POST URL from the saved flow's trigger.
2. In GitHub: **Settings → Secrets and variables → Actions → New
   repository secret**
   - Name: `GBI_FORM_ENDPOINT`
   - Value: the full URL, including `?api-version=...&sig=...`
3. Expose it to the build step in `deploy-static-web-app.yml`:

```yaml
      - name: Build static site
        env:
          GBI_FORM_ENDPOINT: ${{ secrets.GBI_FORM_ENDPOINT }}
        run: python scripts/build-static.py site dist
```

The build substitutes it into `data-endpoint` on the form and
HTML-escapes it, since the URL contains `&`.

**If the secret is unset**, the build prints a warning and leaves the
placeholder in place. The page detects that and shows the mailto
fallback rather than posting into the void. So a missing secret degrades
to "email us directly" — never to a silently discarded inquiry.

### The URL is public once deployed

It ships in the page source, so anyone can find it and POST to it. That
is inherent to any client-side form. The worst case is spam email, not a
data breach — there is nothing to read back. Mitigations in place and
available:

| Control | Where | Status |
|---|---|---|
| Honeypot field | Page | Done |
| Minimum time-on-page (3s) | Page | Done |
| Required-field validation | Page | Done |
| Rate limiting by IP | Front Door custom WAF rule | Available once Front Door is up |
| Rotate the endpoint | Regenerate the flow URL, update the secret | Any time |

Rotating is cheap: regenerate the trigger URL, update the GitHub secret,
re-run the deploy. Nothing else changes.

---

## 6. Nobody is left in the dark

Four behaviours, all built and tested on the page side:

1. **On success**, the form is replaced by a confirmation naming a real
   commitment — back to you within one business day — plus the phone
   number and `sales@mygbi.com` if they need someone sooner.
2. **On failure**, an error appears *with a mailto link pre-filled with
   everything they typed*, addressed to `sales@mygbi.com` and subject-lined
   `Project Inquiry — {company}`. One click sends it. The lead is not lost
   because a flow was down.
3. **While sending**, the button disables and the status reads "Sending
   your inquiry…", so nobody double-submits.
4. **If the endpoint was never configured**, the same fallback appears
   immediately rather than a fake success.

The autoreply in §4 is what closes the loop on the flow side — it is the
one piece the page cannot do on its own. Worth including even if it only
says "we have it, someone will call you."

---

## 7. Testing

Local preview does **not** exercise the real flow: the CORS header names
`https://www.mygbi.com`, so a `localhost` origin is refused. That is
correct behaviour, not a bug. Test against a deployed SWA preview
environment instead.

Verified on the page side:

- POST sent as `text/plain`, body is valid JSON, honeypot excluded
- Success path hides the form and shows the confirmation
- Failure path shows the error and a mailto carrying the typed content
- Unconfigured endpoint falls back instead of pretending to succeed
- Honeypot renders `display: none` and is never seen by a person

One fix this testing surfaced, noted in case it recurs: `form.hidden =
true` did **not** hide the form, because `.form-grid { display: grid }`
overrides the `hidden` attribute's UA `display: none`. `styles.css` now
carries `[hidden] { display: none !important; }`.
