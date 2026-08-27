<?php
/**
 * Shared site footer + video modal + script tag.
 *
 * Included by every page via:
 *   <?php include $_SERVER['DOCUMENT_ROOT'] . '/partials/footer.php'; ?>
 *
 * All paths inside are ABSOLUTE (start with "/") so they resolve correctly
 * regardless of which page is doing the including.
 */
?>
<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <a class="brand" href="/index.php" aria-label="Great Basin Industrial, Home">
          <img class="brand-logo" src="/assets/images/gbi-logo.png" alt="Great Basin Industrial" style="height:48px;" />
        </a>
        <p>Integrated industrial construction across the western United States. Tanks, SMP, I&amp;E, railroad, and fabrication, self-performed under one accountable partner.</p>
      </div>
      <div>
        <h5>About</h5>
        <ul>
          <li><a href="/about/our-story.php">Our Story</a></li>
          <li><a href="/about/leadership.php">Management Team</a></li>
          <li><a href="/about/safety.php">Safety</a></li>
          <li><a href="/about/quality.php">Quality</a></li>
        </ul>
      </div>
      <div>
        <h5>Services</h5>
        <ul>
          <li><a href="/services/tanks-plate-steel.php">Tanks &amp; Plate Steel</a></li>
          <li><a href="/services/structural-mechanical-piping.php">SMP</a></li>
          <li><a href="/services/instrumentation-electrical.php">I&amp;E</a></li>
          <li><a href="/services/railroad.php">Railroad</a></li>
        </ul>
      </div>
      <div>
        <h5>Industries</h5>
        <ul>
          <li><a href="/industries/mining.php">Mining &amp; Minerals</a></li>
          <li><a href="/industries/power-renewables.php">Power &amp; Renewables</a></li>
          <li><a href="/industries/oil-gas.php">Oil, Gas &amp; Chemicals</a></li>
          <li><a href="/industries/water-other.php">Water &amp; Other</a></li>
        </ul>
      </div>
      <div>
        <h5>Connect</h5>
        <ul>
          <li><a href="/projects/index.php">Projects</a></li>
          <li><a href="/careers.php">Careers</a></li>
          <li><a href="/contact.php">Contact</a></li>
          <li><a href="/resources/literature-press.php">Literature &amp; Press</a></li>
          <li><a href="#">LinkedIn &#8599;</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <div>&copy; 2026 Great Basin Industrial &middot; 1284 Flint Meadow Dr, Kaysville, UT 84037 &middot; (801) 543-2100</div>
      <div class="legal">
        <a href="https://www.motivhealth.com/machinereadablefiles/" target="_blank" rel="noopener">ACA &#8599;</a><a href="/terms.php">Terms</a>
      </div>
    </div>
  </div>
</footer>

<!-- Global video modal — opens when any .video-trigger is clicked -->
<div class="video-modal" data-video-modal hidden aria-hidden="true" role="dialog" aria-modal="true" aria-label="Video">
  <div class="video-modal-backdrop" data-video-close></div>
  <div class="video-modal-content" role="document">
    <button type="button" class="video-modal-close" data-video-close aria-label="Close video">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" width="22" height="22"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
    <div class="video-modal-frame" data-video-frame>
      <!-- iframe injected at open -->
    </div>
  </div>
</div>

<script src="/assets/js/site.js"></script>
