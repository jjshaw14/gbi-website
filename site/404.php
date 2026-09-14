<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="robots" content="noindex" />
<title>Page Not Found, Great Basin Industrial</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<!-- Every path on this page MUST be absolute. Azure serves /404.html in
     response to a request for ANY missing URL, at any directory depth, so
     relative paths would resolve against the broken URL and fail. -->
<link rel="stylesheet" href="/assets/css/styles.css" />
</head>
<body>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/partials/header.php'; ?>

<section class="hero hero-sm">
  <div class="hero-media" style="background-image:url('/assets/images/hero-resources.jpg')"></div>
  <div class="hero-overlay"></div>
  <div class="container">
    <span class="eyebrow on-dark">Error 404</span>
    <h1>We Couldn't Find That Page</h1>
    <p class="hero-sub">The page you're looking for has moved or no longer exists. If you followed a link to get here, it's out of date. Everything below will get you where you're going.</p>
  </div>
</section>

<section>
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Where To Next</span>
      <h2>Start Here</h2>
      <p class="lead">The main sections of the site, or reach a person directly.</p>
    </div>
    <div class="hero-actions" style="flex-wrap:wrap; gap:12px;">
      <a class="btn btn-primary" href="/index.php">Home <span class="arr">&rarr;</span></a>
      <a class="btn btn-outline" href="/services/index.php">Services</a>
      <a class="btn btn-outline" href="/industries/index.php">Industries</a>
      <a class="btn btn-outline" href="/projects/index.php">Projects</a>
      <a class="btn btn-outline" href="/about/our-story.php">About</a>
      <a class="btn btn-outline" href="/careers.php">Careers</a>
    </div>
  </div>
</section>

<section class="bg-offwhite">
  <div class="container" style="max-width:820px;">
    <div class="section-head">
      <span class="eyebrow">Need A Person</span>
      <h2>Talk To Us Directly</h2>
      <p class="lead">If you were looking for something specific and can't find it, tell us what you need and we'll point you to it.</p>
    </div>
    <div class="hero-actions" style="flex-wrap:wrap; gap:12px;">
      <a class="btn btn-primary" href="/contact.php">Contact Us <span class="arr">&rarr;</span></a>
      <a class="btn btn-ghost" href="mailto:info@mygbi.com">info@mygbi.com</a>
    </div>
  </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php'; ?>
