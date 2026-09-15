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

### The validity condition

Leaving the compare value blank *does* work for an empty string, but it
misses the case that actually matters: if the field is absent entirely the
value is `null`, and `null` is not equal to `''`, so junk sails through.

This is the Condition action you already have — nothing new to create,
just a change to what goes in the left-hand box.

**Smallest fix, keeps your blank value.** Wrap the left side in `coalesce`,
which turns a missing field into an empty string so the blank comparison
becomes correct:

| Field | Value | How to enter it |
|---|---|---|
| Left | `coalesce(body('Parse_JSON')?['email'], '')` | Expression tab |
| Operator | is not equal to | dropdown |
| Right | *(leave blank)* | — |

To enter an expression: click the left value box, and in the flyout that
opens choose the **Expression** tab (the `fx` icon in the newer designer)
rather than Dynamic content. Paste the expression, then click **Add** /
**OK**. It should show as a small function chip, not as literal text —
if you can still read the raw `coalesce(...)` in the box afterwards, it
went in as a string and the condition will never match.

**Alternative**, if you prefer reading it as a plain test:

| Field | Value |
|---|---|
| Left | `empty(body('Parse_JSON')?['email'])` (Expression tab) |
| Operator | is equal to |
| Right | `false` |

One caveat on this form: typing `false` in the right box gives you the
*string* "false" rather than the boolean. Power Automate normally coerces
this correctly, but if the condition behaves strangely, enter `false`
through the Expression tab too so it is a real boolean.

Worth adding a second row with **And**, on the same pattern, for
`projectDescription`. Those two fields are what make an inquiry actionable,
and requiring both filters most automated junk without ever affecting a real
submitter — the browser already enforces both before the POST.

### What to do in the False branch

Yes, answer it. A False here means a direct POST that did not come from the
form, so return a **Response** with status **400** and the same CORS header
as the success path. The page treats any non-2xx as a failure and shows its
mailto fallback, so nothing is lost even in the odd case that a real person
lands there.

Do not leave the False branch empty. A flow that ends with no Response
returns a `502` the browser cannot read, which works by accident rather
than on purpose.

### The Response action, concretely

Add **Response** (Request connector) as the **last** action on the True
branch, after both emails:

| Field | Value |
|---|---|
| Status Code | `200` |
| Headers | `Access-Control-Allow-Origin` → `*` |
| Headers | `Content-Type` → `application/json` |
| Body | `{"ok": true}` |
| Response Body JSON Schema | leave blank |

On `*` versus a named origin: the endpoint is publicly POSTable no matter
what this header says, and there is nothing to read back, so restricting it
is not a security boundary. `*` also means SWA preview environments work
without editing the flow each time. Tighten it to `https://www.mygbi.com`
later if you prefer — just remember preview builds will then fail CORS.

**Why last:** the Response is what tells the page it worked. Put it before
the emails and a failed send still reports success, so the submitter is told
someone has their inquiry when nobody does. Placing it last means a broken
email step surfaces as a failure and the submitter gets the mailto fallback.

You do **not** need to configure anything for `OPTIONS`. Because the page
sends `text/plain`, the browser never issues a preflight, so there is no
`OPTIONS` request for the flow to answer.

---

## 4b. Auth and CORS — verified live

Resolved 2026-09-15. The trigger was initially set to **"Any user in my
tenant"**, which requires an OAuth token no public visitor can have; every
submission failed with `401 DirectApiAuthorizationRequired`. Changing
**Who Can Trigger The Flow?** to **Anyone** fixed it.

That change rotates the URL — the tenant-auth form has no signature, the
anonymous form carries `?...&sig=...`, and the signature *is* the
authorisation. `GBI_FORM_ENDPOINT` was updated to match and the site
rebuilt. If that setting is ever changed again, the secret must be updated
in the same breath or the form breaks silently.

### What is confirmed against the live origin

Probed with a deliberately empty `email`, which fails the flow's condition
and takes the False branch, so nothing was emailed:

```
status: 400
body:   {"ok":false}
access-control-allow-origin: *
```

That single response confirms four things at once: the endpoint accepts
anonymous POSTs, the `text/plain` content type avoided a CORS preflight,
the validity condition works, and the False-branch Response returns
readable. The whole transport chain is sound.

### What a real submission still has to prove

The True branch — both emails sending and the `200` returning. Worth
checking specifically when someone runs one:

- **`Reply-To` on the internal mail is the submitter**, not the service
  account. This is the single easiest thing to get wrong and the most
  costly: hitting Reply answers a mailbox nobody reads.
- **A multi-line description keeps its line breaks.** Type a description
  with a blank line in it. If it arrives as one run-on paragraph, the
  `replace(..., decodeUriComponent('%0A'), '<br>')` expression did not take.
- **Empty optional fields show an em dash**, not blank rows.
- **The autoreply carries the external footer**, not the internal one
  naming Sophos, the help desk and HR.
- **Logos will render broken** until `www.mygbi.com` resolves. Expected —
  see `LAUNCH-DNS.md` §3b.

---

## 4a. Email templates

Both bodies are in `email-templates/`, ready to paste into the **code view**
(the `</>` button) of each *Send an email (V2)* action:

| File | To | Subject |
|---|---|---|
| `01-internal-new-inquiry.html` | `sales@mygbi.com` | `New project inquiry — @{body('Parse_JSON')?['company']} — @{body('Parse_JSON')?['projectType']}` |
| `02-autoreply-to-submitter.html` | `@{body('Parse_JSON')?['email']}` | `We received your inquiry — Great Basin Industrial` |

Set **Reply To** under Advanced options on both: the submitter's address on
the internal mail, `sales@mygbi.com` on the autoreply.

Three things baked into the templates worth knowing about:

- **Empty optional fields render as an em dash**, via
  `if(empty(...), '—', ...)`, rather than leaving a blank row.
- **The description keeps its line breaks.** A textarea sends `
`, which
  HTML ignores, so it goes through
  `replace(..., decodeUriComponent('%0A'), '<br>')`.
- **The autoreply has a different footer, deliberately.** The standard
  internal footer names the Sophos button, the GBI help desk and HR, and
  says "you are receiving this because your name was added to the request".
  None of that is true for a prospect, and it advertises internal tooling
  to people outside the company. Do not paste the standard footer into the
  autoreply.

### The logo URLs are a cutover dependency

The existing template loads its logos from
`https://mygbi.com/wp-content/uploads/2026/08/gbi.png` — a **WordPress**
path on the current site. That path disappears at cutover, and every email
using this wrapper starts showing broken images.

The templates here point at the new location instead:

```
https://www.mygbi.com/assets/images/logos/gbi.png
https://www.mygbi.com/assets/images/logos/hti.png
```

Those are the two files added to the repo in commit `ec762e1`, at 639x300
and 640x300 — the same 2.13 aspect ratio the template's `width="136"
height="64"` assumes. They will not resolve until the new site is live, so
during testing the logos appear broken; that is expected. **Any other flow
or template using the old WordPress logo URLs needs the same update.**

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
