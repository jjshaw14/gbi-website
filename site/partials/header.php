<?php
/**
 * Shared site header + primary nav.
 *
 * Included by every page via:
 *   <?php $NAV_ACTIVE = 'about'; // one of: about, services, industries, projects, careers
 *         include $_SERVER['DOCUMENT_ROOT'] . '/partials/header.php'; ?>
 *
 * $NAV_ACTIVE controls which top-level nav item gets the `is-active` class.
 * All internal paths inside are ABSOLUTE (start with "/") so they resolve
 * correctly regardless of which page is doing the including.
 *
 * If $NAV_ACTIVE isn't set (e.g. homepage, contact, terms), no item is marked
 * active — that's fine.
 */
$__nav_active = isset($NAV_ACTIVE) ? $NAV_ACTIVE : '';
function __gbi_nav_active($key, $current) {
  return $current === $key ? ' is-active' : ' ';
}
?>
<header class="site-header is-dark">
  <div class="container nav-row">
    <a class="brand" href="/index.php" aria-label="Great Basin Industrial, Home">
      <img class="brand-logo" src="/assets/images/gbi-logo.png" alt="Great Basin Industrial" />
    </a>
    <nav class="primary-nav" aria-label="Primary">
      <div class="nav-item has-dropdown">
        <a href="/about/our-story.php" class="nav-parent<?php echo __gbi_nav_active('about', $__nav_active); ?>" aria-haspopup="true" aria-expanded="false">About <span class="caret">▾</span></a>
        <div class="nav-dropdown" role="menu">
          <a href="/about/our-story.php" class="dd-overview" role="menuitem"><strong>Our Story</strong><span>Built by builders. How GBI started and where it's going.</span></a>
          <a href="/about/leadership.php" role="menuitem"><strong>Management Team</strong><span>A company built and run by builders. Meet the leaders.</span></a>
          <a href="/about/safety.php" role="menuitem"><strong>Safety</strong><span>GBI-SHARE — safety isn't a checkbox, it's a daily operating habit.</span></a>
          <a href="/about/quality.php" role="menuitem"><strong>Quality</strong><span>GBI-CHECK — built right the first time. ASME, API, AWWA, AISC.</span></a>
          <a href="/services/turnkey-delivery.php" role="menuitem"><strong>Turnkey Delivery</strong><span>Full-scope project execution, coordinating all trades as needed from planning through startup.</span></a>
          <a href="/services/preconstruction-engineering.php" role="menuitem"><strong>Preconstruction Engineering</strong><span>In-house engineering: critical lift plans, erection drawings, design-build.</span></a>
        </div>
      </div>

      <div class="nav-item has-dropdown">
        <a href="/services/index.php" class="nav-parent<?php echo __gbi_nav_active('services', $__nav_active); ?>" aria-haspopup="true" aria-expanded="false">Services <span class="caret">▾</span></a>
        <div class="nav-dropdown" role="menu">
          <a href="/services/index.php" class="dd-overview" role="menuitem"><strong>All Services</strong><span>Multiple self-performed disciplines under one accountable contractor.</span></a>
          <a href="/services/tanks-plate-steel.php" role="menuitem"><strong>Tanks &amp; Plate Steel</strong><span>API & AWWA tanks, clarifiers, scrubbers, stacks. Shop and field fabrication.</span></a>
          <a href="/services/structural-mechanical-piping.php" role="menuitem"><strong>Structural, Mechanical &amp; Piping</strong><span>Industrial structures, process piping, mechanical installation.</span></a>
          <a href="/services/instrumentation-electrical.php" role="menuitem"><strong>Instrumentation &amp; Electrical</strong><span>I&amp;E construction, MCC buildings, controls, data centers.</span></a>
          <a href="/services/railroad.php" role="menuitem"><strong>Railroad</strong><span>Industrial rail construction, spur installation, derailment response.</span></a>
        </div>
      </div>

      <div class="nav-item has-dropdown">
        <a href="/industries/index.php" class="nav-parent<?php echo __gbi_nav_active('industries', $__nav_active); ?>" aria-haspopup="true" aria-expanded="false">Industries <span class="caret">▾</span></a>
        <div class="nav-dropdown" role="menu">
          <a href="/industries/index.php" class="dd-overview" role="menuitem"><strong>All Industries</strong><span>Deep experience across the industries that power America.</span></a>
          <a href="/industries/mining.php" role="menuitem"><strong>Mining &amp; Minerals</strong><span>Built for the most demanding environments in industrial construction.</span></a>
          <a href="/industries/power-renewables.php" role="menuitem"><strong>Power &amp; Renewables</strong><span>Carbon capture, renewables, and the next generation of energy infrastructure.</span></a>
          <a href="/industries/oil-gas.php" role="menuitem"><strong>Oil, Gas &amp; Chemicals</strong><span>Maximum-consequence environments. Process safety as the operating standard.</span></a>
          <a href="/industries/water-other.php" role="menuitem"><strong>Water &amp; Other</strong><span>The work communities depend on. Built to last.</span></a>
          <a href="/industries/advanced-facilities.php" role="menuitem"><strong>Advanced Facilities</strong><span>Data centers and semiconductor plants. Power, water, and precision at industrial scale.</span></a>
        </div>
      </div>

      <a href="/projects/index.php" class="<?php echo trim(__gbi_nav_active('projects', $__nav_active)); ?>">Projects</a>
      <a href="/careers.php" class="<?php echo trim(__gbi_nav_active('careers', $__nav_active)); ?>">Careers</a>
    </nav>
    <div class="nav-spacer"></div>
    <a class="nav-cta" href="/contact.php">Contact Us &rarr;</a>
    <button class="nav-mobile" aria-label="Menu"><span></span><span></span><span></span></button>
  </div>
</header>
