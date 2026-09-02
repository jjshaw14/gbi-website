<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Great Basin Industrial, Built by Builders</title>
  <meta name="description" content="Integrated industrial construction, tanks, SMP, I&amp;E, railroad, and fabrication. Self-performed. Built by builders." />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css" />
</head>
<body>

<div class="wf-strip">
  <div class="container"><strong>Prototype</strong> Interactive wireframe · Home / polished · Other pages skeleton</div>
</div>

<!-- ============ HEADER ============ -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/partials/header.php'; ?>

<!-- ============ HERO ============ -->
<section class="hero">
  <!-- Background video — Vimeo player set up for muted autoplay loop, no controls.
       hero-home.jpg sits underneath as a poster shown while the video loads. -->
  <div class="hero-video" aria-hidden="true">
    <img class="hero-video-fallback" src="assets/images/hero-home-poster.jpg" alt="" />
    <iframe
      src="https://player.vimeo.com/video/1199878784?background=1&autoplay=1&loop=1&muted=1&autopause=0&dnt=1&app_id=122963"
      frameborder="0"
      allow="autoplay; fullscreen; picture-in-picture; clipboard-write; encrypted-media; web-share"
      referrerpolicy="strict-origin-when-cross-origin"
      allowfullscreen
      title="GBI Website"
      loading="eager"></iframe>
  </div>
  <div class="hero-overlay"></div>
  <div class="container">
    <span class="eyebrow on-dark" style="color:#144b9c;">Integrated Industrial Construction</span>
    <h1>Built by<br/>Builders</h1>
    <p class="hero-sub">Integrated industrial construction, delivered right. From one of the most demanding crafts in the industry, tanks, to structural, mechanical, piping, electrical, and rail. One company. One standard. Every project.</p>
    <div class="hero-actions">
      <a class="btn btn-primary" href="services/index.php">Our Services <span class="arr">→</span></a>
      <a class="btn btn-ghost" href="projects/index.php">View Projects <span class="arr">→</span></a>
    </div>
  </div>
</section>

<!-- ============ STATS BAR ============ -->
<section class="stats-bar tight">
  <div class="container">
    <div class="stats-grid">
      <div>
        <div class="stat-num"><span data-count="600">0</span><span class="suf">+</span></div>
        <div class="stat-label">Employees</div>
      </div>
      <div>
        <div class="stat-num"><span data-count="80">0</span><span class="suf">%+</span></div>
        <div class="stat-label">Repeat Customers</div>
      </div>
      <div>
        <div class="stat-num"><span data-count="40">0</span><span class="suf">+</span></div>
        <div class="stat-label">States Licensed</div>
      </div>
      <div>
        <div class="stat-num"><span data-count="0.40">0</span></div>
        <div class="stat-label">2024 TRIR · Industry Avg 3.7+</div>
      </div>
    </div>
  </div>
</section>

<!-- ============ WHO WE ARE ============ -->
<section>
  <div class="container two-col">
    <div>
      <span class="eyebrow">Who We Are</span>
      <h2>Integrated Construction. Built by Builders</h2>
    </div>
    <div>
      <p>Great Basin Industrial is a turnkey construction partner serving the oil &amp; gas, mining, power, water, advanced facilities, and infrastructure markets across the United States and beyond.</p>
      <p>We started in tanks, a technically demanding craft, and we built everything that came after on the same foundation: disciplined crews, uncompromising quality, and accountability that runs through every layer of the company.</p>
      <p>Today, GBI self-performs across tanks and plate steel, structural, mechanical and piping, instrumentation and electrical, and railroad. One contractor. One point of accountability. Less coordination burden for you.</p>

      <div class="pullquote">
        We're built to be the most accountable contractor you work with. Every project, one point of ownership. Built and led by people who have done the work.
      </div>
    </div>
  </div>
</section>

<!-- ============ SERVICES ============ -->
<section class="bg-offwhite">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Our Services</span>
      <h2>What We Build</h2>
      <p class="lead">Multiple self-performed disciplines, one accountable contractor. Click any tile to explore the capability in depth.</p>
    </div>

    <div class="tile-grid tile-grid--4col">
      <a class="tile" href="services/tanks-plate-steel.php">
        <div class="tile-icon"><svg viewBox="0 0 40 40" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="M6 14 C6 10 12 8 20 8 C28 8 34 10 34 14 L34 34 L6 34 Z M6 21 L34 21 L34 24 L6 24 Z"/></svg></div>
        <h3>Tanks &amp; Plate Steel</h3>
        <p>API and AWWA tanks, clarifiers, digesters, scrubbers, stacks.</p>
        <div class="tile-link"><span>Explore</span><span>→</span></div>
      </a>
      <a class="tile" href="services/structural-mechanical-piping.php">
        <div class="tile-icon"><svg viewBox="0 0 40 40" fill="currentColor" aria-hidden="true"><rect x="2" y="26" width="12" height="6"/><rect x="26" y="26" width="12" height="6"/><rect x="10" y="22" width="4" height="14"/><rect x="26" y="22" width="4" height="14"/><rect x="14" y="22" width="12" height="14"/><rect x="18" y="10" width="4" height="14"/><rect x="10" y="8" width="20" height="4"/><rect x="16" y="3" width="8" height="6"/></svg></div>
        <h3>Structural, Mechanical &amp; Piping</h3>
        <p>Industrial structures, process piping, mechanical installation.</p>
        <div class="tile-link"><span>Explore</span><span>→</span></div>
      </a>
      <a class="tile" href="services/instrumentation-electrical.php">
        <div class="tile-icon"><svg viewBox="0 0 40 40" fill="currentColor" aria-hidden="true"><polygon points="24,4 8,22 18,22 16,36 32,18 22,18 24,4"/></svg></div>
        <h3>Instrumentation &amp; Electrical</h3>
        <p>I&amp;E construction, MCC buildings, controls, data centers.</p>
        <div class="tile-link"><span>Explore</span><span>→</span></div>
      </a>
      <a class="tile" href="services/railroad.php">
        <div class="tile-icon"><svg viewBox="0 0 40 40" fill="currentColor" aria-hidden="true"><circle cx="20" cy="20" r="15" fill="none" stroke="currentColor" stroke-width="3"/><line x1="11" y1="11" x2="29" y2="29" stroke="currentColor" stroke-width="3.5" stroke-linecap="round"/><line x1="29" y1="11" x2="11" y2="29" stroke="currentColor" stroke-width="3.5" stroke-linecap="round"/><text x="8" y="24" text-anchor="middle" font-family="Inter, sans-serif" font-size="10" font-weight="900">R</text><text x="32" y="24" text-anchor="middle" font-family="Inter, sans-serif" font-size="10" font-weight="900">R</text></svg></div>
        <h3>Railroad</h3>
        <p>Industrial rail construction, spur installation, derailment response.</p>
        <div class="tile-link"><span>Explore</span><span>→</span></div>
      </a>
    </div>
  </div>
</section>

<!-- ============ INDUSTRIES ============ -->
<section>
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Industries</span>
      <h2>The Industries We Serve</h2>
    </div>
    <div class="tile-grid">
      <a class="photo-tile" href="industries/mining.php" style="background-image:url('assets/images/industry-mining.jpg')">
        <div>
          <h3>Mining &amp; Minerals</h3>
          <div class="tile-link">Explore →</div>
        </div>
      </a>
      <a class="photo-tile" href="industries/power-renewables.php" style="background-image:url('assets/images/industry-power.jpg')">
        <div>
          <h3>Power &amp; Renewables</h3>
          <div class="tile-link">Explore →</div>
        </div>
      </a>
      <a class="photo-tile" href="industries/oil-gas.php" style="background-image:url('assets/images/industry-oil.jpg')">
        <div>
          <h3>Oil, Gas &amp; Chemicals</h3>
          <div class="tile-link">Explore →</div>
        </div>
      </a>
      <a class="photo-tile" href="industries/water-other.php" style="background-image:url('assets/images/industry-water.jpg')">
        <div>
          <h3>Water &amp; Other</h3>
          <div class="tile-link">Explore →</div>
        </div>
      </a>
      <a class="photo-tile" href="industries/advanced-facilities.php" style="background-image:url('assets/images/industry-power.jpg')">
        <div>
          <h3>Advanced Facilities</h3>
          <div class="tile-link">Explore →</div>
        </div>
      </a>
      <a class="photo-tile" href="industries/index.php" style="background-image:url('assets/images/industry-food-nyzai.png')">
        <div>
          <h3>Food, Beverage &amp; Agriculture</h3>
          <div class="tile-link">Explore →</div>
        </div>
      </a>
    </div>
  </div>
</section>

<!-- ============ WHY US ============ -->
<section class="bg-offwhite">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">The GBI Difference</span>
      <h2>Why Customers Keep Coming Back</h2>
      <p class="lead">Over 80% of our work comes from repeat customers. That's not a marketing number. It's the result of showing up the same way every time, through schedule pressure, weather delays, and scope changes.</p>
    </div>
    <div class="feature-grid">
      <div class="feature">
        <h3>Builder-Led.</h3>
        <p>GBI is run by people who came up through the field. Our PMs, superintendents, and executives have operated equipment, run crews, and solved real problems on real job sites. That perspective changes how decisions get made.</p>
      </div>
      <div class="feature">
        <h3>Self-Perform Capability.</h3>
        <p>We don't just manage subcontractors, we do the work. Multi-craft self-performance reduces interfaces, compresses schedules, and puts accountability exactly where it belongs: with us.</p>
      </div>
      <div class="feature">
        <h3>Systematic Excellence.</h3>
        <p>The processes GBI built in tanks, one of the most technically demanding crafts in the industry, are the same processes applied across every trade. Discipline and proven process don't change depending on what we're building.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ PROCESS ============ -->
<section class="bg-deep on-dark">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow on-dark">The Proven Partner Process</span>
      <h2>Every Project, the Same Disciplined Approach</h2>
    </div>
    <div class="process">
      <div class="process-step">
        <div class="num">01 / Discovery</div>
        <h4>Listen &amp; Align</h4>
        <p>We ask the right questions and align our capabilities to your needs.</p>
      </div>
      <div class="process-step">
        <div class="num">02 / Planning</div>
        <h4>Value-Engineer</h4>
        <p>We protect scope, schedule, and budget before work begins.</p>
      </div>
      <div class="process-step">
        <div class="num">03 / Pre-Con</div>
        <h4>Kickoff</h4>
        <p>Dedicated team, comprehensive kickoff, zero ambiguity going to field.</p>
      </div>
      <div class="process-step">
        <div class="num">04 / Execution</div>
        <h4>Build</h4>
        <p>Proactive communication, transparent reporting, adaptability built in.</p>
      </div>
      <div class="process-step">
        <div class="num">05 / Completion</div>
        <h4>Handoff</h4>
        <p>Thorough handoff that reflects genuine passion for the craft.</p>
      </div>
      <div class="process-step">
        <div class="num">06 / Partnership</div>
        <h4>Repeat</h4>
        <p>Clients return, confident in the relationship, not just the result.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ FEATURED PROJECTS ============ -->
<section>
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Built Work</span>
      <h2>Featured Projects</h2>
    </div>

    <div class="project-grid">
      <a class="project-card" href="projects/gold-mine-processing.php" style="background-image:url('assets/images/project-gold-mine.jpg')">
        <div class="pc-tag">Gold Processing</div>
        <div>
          <h3>Gold Mine Processing Plant</h3>
          <div class="pc-meta">Haile, SC &middot; Tanks, SMP, I&amp;E, Turnkey</div>
        </div>
      </a>
      <a class="project-card" href="projects/elevated-conveyor.php" style="background-image:url('assets/images/project-elevated-conveyor.jpg')">
        <div class="pc-tag">Power</div>
        <div>
          <h3>Elevated Conveyor Tear Down &amp; Replacement</h3>
          <div class="pc-meta">Sooner Plant, OK &middot; 2,100 LF &middot; 90-day outage</div>
        </div>
      </a>
      <a class="project-card" href="projects/fgd-wet-scrubber.php" style="background-image:url('assets/images/project-fgd-scrubber.jpg')">
        <div class="pc-tag">Air Pollution Control</div>
        <div>
          <h3>62&prime;&Oslash; &times; 155&prime; FGD Wet Scrubber</h3>
          <div class="pc-meta">CPS Energy J.K. Spruce, San Antonio, TX</div>
        </div>
      </a>
      <a class="project-card" href="projects/coors-g150.php" style="background-image:url('assets/images/case-studies/coors-g150-hero.jpg')">
        <div class="pc-tag">Food &amp; Beverage</div>
        <div>
          <h3>Coors G150 Brewery Tank Project</h3>
          <div class="pc-meta">Golden, CO &middot; 118 stainless tanks, ~120K craft manhours</div>
        </div>
      </a>
    </div>

    <div style="text-align:center; margin-top:40px;">
      <a class="btn btn-outline" href="projects/index.php">View All Projects <span class="arr">→</span></a>
    </div>
  </div>
</section>

<!-- ============ SAFETY CALLOUT ============ -->
<section class="safety-callout on-dark">
  <div class="container">
    <div class="safety-row">
      <div>
        <span class="eyebrow on-dark">GBI-SHARE</span>
        <h2>Safety Is How We Measure Success</h2>
        <p class="lead">A project that finishes on time with an injury isn't a success. Every crew on every GBI job site operates under GBI-SHARE, a proactive, behavior-based safety system that makes safety a daily habit, not a checklist.</p>
        <a class="btn btn-lime" href="about/safety.php">Our Safety Culture <span class="arr">→</span></a>
      </div>
      <div class="trir-block">
        <div class="trir-item">
          <div class="v">0.40</div>
          <div class="l">2024 TRIR</div>
        </div>
        <div class="trir-item">
          <div class="v">3.7+</div>
          <div class="l">Industry Avg</div>
        </div>
        <div class="trir-item">
          <div class="v">&lt;0.30</div>
          <div class="l">2028 Goal</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ TRUST BAR ============ -->
<section class="trust-bar">
  <div class="container">
    <p>Trusted by industry leaders across mining, energy, oil &amp; gas, and chemicals</p>
    <div class="logo-row">
      <div class="logo-cell"><img src="assets/images/logo-kindermorgan.png" alt="Kinder Morgan" /></div>
      <div class="logo-cell"><img src="assets/images/logo-barrick.png" alt="Barrick" /></div>
      <div class="logo-cell"><img src="assets/images/logo-silvereagle.png" alt="SilverEagle Refining" /></div>
      <div class="logo-cell"><img src="assets/images/logo-kiewit.jpg" alt="Kiewit" /></div>
      <div class="logo-cell"><img src="assets/images/logo-burns-mcdonnell.png" alt="Burns &amp; McDonnell" /></div>
      <div class="logo-cell"><img src="assets/images/logo-coors.jpg" alt="Coors" /></div>
      <div class="logo-cell"><img src="assets/images/logo-oceanagold.png" alt="OceanaGold" /></div>
      <div class="logo-cell"><img src="assets/images/logo-freeport.png" alt="Freeport-McMoRan" /></div>
      <div class="logo-cell"><img src="assets/images/logo-rio-tinto.png" alt="Rio Tinto" /></div>
      <div class="logo-cell"><img src="assets/images/logo-nustar.png" alt="NuStar" /></div>
      <div class="logo-cell"><img src="assets/images/logo-sinclair.png" alt="Sinclair" /></div>
      <div class="logo-cell"><img src="assets/images/logo-oge-energy.jpg" alt="OGE Energy" /></div>
      <div class="logo-cell"><img src="assets/images/logo-pacificorp.jpg" alt="PacifiCorp" /></div>
    </div>
  </div>
</section>

<!-- ============ CAREERS TEASER ============ -->
<section class="bg-offwhite">
  <div class="container two-col-flip" style="align-items:center; gap:120px;">
    <div>
      <span class="eyebrow">Careers</span>
      <h2>This Is Great Basin Nation</h2>
      <p class="lead">We build careers the same way we build everything else: one day at a time, with craft and with care. If you've done the work, you know what it means to do it right. That's who we're looking for.</p>
      <a class="btn btn-primary" href="careers.php">Explore Careers <span class="arr">→</span></a>
    </div>
    <div style="min-height:340px; background-image:url('assets/images/hero-fab.png'); background-size:cover; background-position:center; margin-top:48px;"></div>
  </div>
</section>

<!-- ============ FINAL CTA ============ -->
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

<!-- ============ FOOTER ============ -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php'; ?>
</body>
</html>
