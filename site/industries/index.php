<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Industries, Great Basin Industrial</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/styles.css" />
</head>
<body>

<?php $NAV_ACTIVE = 'industries'; include $_SERVER['DOCUMENT_ROOT'] . '/partials/header.php'; ?>

<section class="hero hero-sm">
  <div class="hero-media" style="background-image:url('../assets/images/hero-industries.jpg')"></div>
  <div class="hero-overlay"></div>
  <div class="photo-direction">
    <strong>Photo · Dramatic industrial landscape</strong>
    <span>Dramatic wide-angle industrial landscape, refinery at dusk, mine with equipment, power plant with steam. Communicates scale and industrial depth.</span>
  </div>
  <div class="container">
    <div class="crumbs"><a href="../index.php">Home</a><span>/</span><a href="index.php">Industries</a><span>/</span>Industries Overview</div>
    <span class="eyebrow on-dark">Industries Overview</span>
    <h1>Deep Experience Across the Industries That Power America</h1>
    <p class="hero-sub">GBI has worked in virtually every major heavy industrial sector, often in the most demanding projects those industries produce.</p>
  </div>
</section>

<section class="">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Industries</span>
      <h2>Where We've Built</h2>
      <p class="lead">That breadth of experience means our teams understand how different facilities operate, how different owners make decisions, and what it takes to deliver in environments where the margin for error is low.</p>
    </div>
    <div class="tile-grid tile-grid--4col">
      <a class="tile" href="mining.php">
        <div class="tile-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="2 20 8 10 12 16 16 6 22 20"/><line x1="2" y1="20" x2="22" y2="20"/></svg></div>
        <h3>Mining &amp; Minerals</h3>
        <p>Built for the most demanding environments in industrial construction. Barrick, Newmont, OceanaGold, Freeport-McMoRan, Rio Tinto.</p>
        <div class="tile-link"><span>Explore</span><span>&rarr;</span></div>
      </a>
      <a class="tile" href="power-renewables.php">
        <div class="tile-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/></svg></div>
        <h3>Power &amp; Renewables</h3>
        <p>Carbon capture, renewable fuels, conventional power, and the next generation of energy infrastructure.</p>
        <div class="tile-link"><span>Explore</span><span>&rarr;</span></div>
      </a>
      <a class="tile" href="oil-gas.php">
        <div class="tile-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="5" y="3" width="14" height="18" rx="1"/><line x1="5" y1="9" x2="19" y2="9"/><line x1="5" y1="15" x2="19" y2="15"/></svg></div>
        <h3>Oil, Gas &amp; Chemicals</h3>
        <p>Maximum-consequence environments. Process safety as the operating standard. Tanks, piping, structural, I&amp;E, and rail.</p>
        <div class="tile-link"><span>Explore</span><span>&rarr;</span></div>
      </a>
      <a class="tile" href="water-other.php">
        <div class="tile-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"/></svg></div>
        <h3>Water &amp; Other</h3>
        <p>Work communities depend on, AWWA tanks, clarifiers, digesters, reservoir covers. Built to last.</p>
        <div class="tile-link"><span>Explore</span><span>&rarr;</span></div>
      </a>
    </div>
  </div>
</section>

<section class="final-cta">
  <div class="container">
    <span class="eyebrow on-dark">Ready to Build Something?</span>
    <h2>Tell us about your project. We'll tell you how we'd build it</h2>
    <div class="actions">
      <a class="btn btn-lime" href="../contact.php">Start a Project <span class="arr">→</span></a>
      <a class="btn btn-ghost" href="../contact.php">Contact Us <span class="arr">→</span></a>
    </div>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php'; ?>
</body>
</html>
