<?php
/* Floating "Feedback" button for the GBI draft site.
   Include this at the end of the shared footer (before </body>) on every page:
       <?php include __DIR__ . '/feedback-widget.php'; ?>
   ...adjusting the path if the footer lives in a subfolder, e.g.:
       <?php include dirname(__DIR__) . '/feedback-widget.php'; ?>
   It links to /feedback.php with the current page pre-selected. */
$__fb_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
?>
<a href="/feedback.php?page=<?php echo urlencode($__fb_uri); ?>" target="_blank" rel="noopener"
   style="position:fixed;right:18px;bottom:18px;z-index:99999;background:#E0531D;color:#fff;
          font:700 13px/1 'Segoe UI',system-ui,Arial,sans-serif;padding:11px 16px;border-radius:24px;
          text-decoration:none;box-shadow:0 4px 14px rgba(0,0,0,.3)">
  💬 Feedback
</a>
