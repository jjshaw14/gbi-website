<?php
/* Floating "Feedback" button for the GBI site — gated by an invite cookie.

   HOW IT WORKS
   -------------
   Public visitors see nothing. To hand out feedback access, share the URL:
       https://mygbi.com/?fb=<INVITE_TOKEN>
   ...where <INVITE_TOKEN> is the FB_INVITE_TOKEN value below. That URL can
   point at any page on the site — the token is picked up by a tiny JS
   snippet, saved as a 90-day cookie, then the query string is stripped and
   the button starts appearing.

   To revoke on a single browser: visit any page with `?fb=off`.
   To rotate access for everyone: change FB_INVITE_TOKEN below and redeploy.

   Include this at the bottom of the shared footer:
       <?php include $_SERVER['DOCUMENT_ROOT'] . '/feedback-widget.php'; ?>
*/

// -- CONFIG ------------------------------------------------------------------
// Anyone who clicks a URL containing `?fb=<this string>` gets a 90-day cookie
// and starts seeing the feedback button. Change this and redeploy to revoke
// access for everyone who hasn't already got the cookie.
const FB_INVITE_TOKEN = 'review-access';
const FB_COOKIE_NAME  = 'gbi_fb_invite';
const FB_COOKIE_VALUE = 'ok'; // opaque; not the token itself
// ----------------------------------------------------------------------------

$__fb_uri     = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
$__fb_hasCookie = isset($_COOKIE[FB_COOKIE_NAME]) && $_COOKIE[FB_COOKIE_NAME] === FB_COOKIE_VALUE;
?>
<script>
/* Feedback-invite handshake. Runs on every page. Small enough to inline. */
(function(){
  try {
    var params = new URLSearchParams(location.search);
    var fb = params.get('fb');
    if (fb === null) return;
    var TOKEN = <?php echo json_encode(FB_INVITE_TOKEN); ?>;
    var NAME  = <?php echo json_encode(FB_COOKIE_NAME); ?>;
    var VALUE = <?php echo json_encode(FB_COOKIE_VALUE); ?>;
    var expires;
    if (fb === TOKEN) {
      // 90-day opt-in
      var d = new Date(); d.setTime(d.getTime() + 90*24*60*60*1000);
      document.cookie = NAME + '=' + VALUE + ';expires=' + d.toUTCString() + ';path=/;SameSite=Lax';
    } else if (fb === 'off') {
      // Immediate opt-out
      document.cookie = NAME + '=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/';
    } else {
      return; // unknown value — leave URL alone
    }
    // Strip the ?fb=... param so the URL doesn't linger in address bars, tabs, or shares.
    params.delete('fb');
    var clean = location.pathname + (params.toString() ? '?' + params.toString() : '') + location.hash;
    history.replaceState({}, '', clean);
    // Reload so the PHP side notices the new cookie and renders (or hides) the button.
    location.reload();
  } catch (e) { /* silently ignore — this is a non-critical enhancement */ }
})();
</script>
<?php if ($__fb_hasCookie): ?>
<a href="/feedback.php?page=<?php echo urlencode($__fb_uri); ?>" target="_blank" rel="noopener"
   title="Leave feedback (invited reviewers only). Visit any page with ?fb=off to turn this off."
   style="position:fixed;right:18px;bottom:18px;z-index:99999;background:#E0531D;color:#fff;
          font:700 13px/1 'Segoe UI',system-ui,Arial,sans-serif;padding:11px 16px;border-radius:24px;
          text-decoration:none;box-shadow:0 4px 14px rgba(0,0,0,.3)">
  💬 Feedback
</a>
<?php endif; ?>
