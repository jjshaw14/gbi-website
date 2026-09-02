<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Contact, Great Basin Industrial</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/styles.css" />
</head>
<body>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/partials/header.php'; ?>

<section class="hero hero-sm">
  <div class="hero-media" style="background-image:url('assets/images/hero-contact.jpg')"></div>
  <div class="hero-overlay"></div>
  <div class="photo-direction">
    <strong>Photo · Functional layout, no hero needed</strong>
    <span>Per PDF: 'Simple, clean layout. No hero needed, this page is functional. GBI blue and white, minimal.' This bar replaces the hero photo on production.</span>
  </div>
  <div class="container">
    <div class="crumbs"><a href="index.php">Home</a><span>/</span>Contact</div>
    <span class="eyebrow on-dark">Contact</span>
    <h1>Let's Talk</h1>
    <p class="hero-sub">Whether you have a project to bid, a question about our capabilities, or want to connect with our team, we're easy to reach and we respond quickly.</p>
  </div>
</section>

<section>
  <div class="container two-col">
    <div>
      <span class="eyebrow">Reach Our Team Directly</span>
      <h2>By Department</h2>
      <div style="margin-top:24px;">
        <div style="margin-bottom:14px;">
          <div style="font-size:11px; letter-spacing:.16em; text-transform:uppercase; color:var(--muted); font-weight:700;">Bidding & Project Inquiries</div>
          <a href="mailto:sales@mygbi.com" style="font-size:1.1rem; font-weight:600;">sales@mygbi.com</a>
        </div>
        <div style="margin-bottom:14px;">
          <div style="font-size:11px; letter-spacing:.16em; text-transform:uppercase; color:var(--muted); font-weight:700;">Phone</div>
          <a href="tel:8015432100" style="font-size:1.1rem; font-weight:600;">801.543.2100 *1</a>
        </div>
        <div style="margin-bottom:14px;">
          <div style="font-size:11px; letter-spacing:.16em; text-transform:uppercase; color:var(--muted); font-weight:700;">General</div>
          <a href="mailto:info@mygbi.com" style="font-size:1.1rem; font-weight:600;">info@mygbi.com</a>
        </div>
        <div>
          <div style="font-size:11px; letter-spacing:.16em; text-transform:uppercase; color:var(--muted); font-weight:700;">Careers</div>
          <a href="mailto:careers@mygbi.com" style="font-size:1.1rem; font-weight:600;">careers@mygbi.com</a>
        </div>
      </div>
    </div>
    <div style="background:var(--gbi-offwhite); padding:32px; border:1px solid var(--rule);">
      <form class="form-grid" onsubmit="return false;">
        <div class="field"><label>First Name</label><input type="text" /></div>
        <div class="field"><label>Last Name</label><input type="text" /></div>
        <div class="field"><label>Company</label><input type="text" /></div>
        <div class="field"><label>Title</label><input type="text" /></div>
        <div class="field"><label>Phone</label><input type="tel" /></div>
        <div class="field"><label>Email</label><input type="email" /></div>
        <div class="field full"><label>Project Location</label><input type="text" placeholder="City, State" /></div>
        <div class="field full"><label>Project Type</label>
          <select>
            <option>Tank</option>
            <option>SMP</option>
            <option>I&E</option>
            <option>Railroad</option>
            <option>Coatings</option>
            <option>GC</option>
            <option>Not Sure</option>
          </select>
        </div>
        <div class="field full"><label>Project Description</label><textarea placeholder="Tell us about the scope, timeline, and any constraints..."></textarea></div>
        <div class="field full"><label>How did you hear about us?</label><input type="text" /></div>
        <div class="full"><button type="submit" class="btn btn-primary">Submit <span class="arr">→</span></button></div>
      </form>
    </div>
  </div>
</section>

<section class="bg-offwhite">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Office Locations</span>
      <h2>Offices Across the West</h2>
      <p class="lead">Headquartered north of Salt Lake City. Field offices and warehouses positioned for the work we serve across the western United States.</p>
    </div>
    <div class="office-grid">
      <div class="office">
        <h4>Headquarters</h4>
        <p>25 miles north of SLC<br/>1284 Flint Meadow Dr.<br/>Kaysville, UT 84037<br/><a href="tel:8015432100">Tel: (801) 543-2100</a></p>
      </div>
      <div class="office">
        <h4>Fab & Field Warehouse</h4>
        <p>I-15 Exit 392<br/>20655 N 6000 W<br/>Plymouth, UT 84330<br/><a href="tel:4355381250">Tel: (435) 538-1250</a></p>
      </div>
      <div class="office">
        <h4>Permian</h4>
        <p>3722 Nat. Parks HW<br/>Carlsbad, NM 88220<br/><a href="tel:5753956868">Tel: (575) 395-6868</a></p>
      </div>
      <div class="office">
        <h4>WY Field Services</h4>
        <p>I-80 Exit 104<br/>2000 Mineral Dr.<br/>Rock Springs, WY 82901<br/><a href="tel:3073626543">Tel: (307) 362-6543</a></p>
      </div>
      <div class="office">
        <h4>Austin Electric</h4>
        <p>16813 Calply Dr.<br/>Round Rock, TX 78664<br/><a href="tel:5126432015">Tel: (512) 643-2015</a></p>
      </div></div>
    <div class="wf-note" style="margin-top:24px;">
      <strong>Map Direction</strong>
      Embedded Google Map showing office locations and coverage territory.
    </div>
  </div>
</section>

<section class="final-cta">
  <div class="container">
    <span class="eyebrow on-dark">Ready to Build Something?</span>
    <h2>Tell us about your project. We'll tell you how we'd build it</h2>
    <div class="actions">
      <a class="btn btn-lime" href="contact.php">Start a Project <span class="arr">→</span></a>
      <a class="btn btn-ghost" href="contact.php">Contact Us <span class="arr">→</span></a>
    </div>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php'; ?>
</body>
</html>
