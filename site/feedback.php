<?php
/* ============================================================================
   GBI DRAFT-SITE FEEDBACK BOARD — single-file, no database.
   Drop this file in the webroot. It self-creates ./feedback-data/ (JSON store)
   and ./feedback-data/uploads/ (screenshots) on first run, including an
   .htaccess that disables script execution in the uploads folder.
   Optional: include feedback-widget.php in the shared footer to add a floating
   "Feedback" button on every page that pre-selects the page being viewed.
   ============================================================================ */

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
header('X-Content-Type-Options: nosniff');

$DATA_DIR   = __DIR__ . '/feedback-data';
$UPLOAD_DIR = $DATA_DIR . '/uploads';
$STORE      = $DATA_DIR . '/feedback.json';
$MAX_IMG_BYTES = 8 * 1024 * 1024;   // 8 MB per image
$MAX_IMGS_PER_COMMENT = 3;

/* ---- one-time setup ---- */
if (!is_dir($DATA_DIR))   { @mkdir($DATA_DIR, 0755, true); }
if (!is_dir($UPLOAD_DIR)) { @mkdir($UPLOAD_DIR, 0755, true); }
$ht = $UPLOAD_DIR . '/.htaccess';
if (!file_exists($ht)) {
  @file_put_contents($ht,
    "php_flag engine off\n" .
    "RemoveHandler .php .phtml .php3 .php4 .php5 .php7 .phps\n" .
    "<FilesMatch \"\\.(php|phtml|php3|php4|php5|php7|phps|cgi|pl|py|sh)$\">\n" .
    "  Require all denied\n" .
    "</FilesMatch>\n");
}

/* ---- the site's page index (mirrors the draft's navigation) ---- */
$PAGES = array(
  'General'    => array('__general__' => 'Site-wide / general'),
  'Home'       => array('index.php' => 'Home'),
  'About'      => array(
    'about/our-story.php'  => 'Our Story',
    'about/leadership.php' => 'Management Team',
    'about/safety.php'     => 'Safety',
    'about/quality.php'    => 'Quality',
  ),
  'Services'   => array(
    'services/index.php'                        => 'Services (overview)',
    'services/turnkey-delivery.php'             => 'Turnkey Delivery',
    'services/preconstruction-engineering.php'  => 'Preconstruction Engineering',
    'services/tanks-plate-steel.php'            => 'Tanks & Plate Steel',
    'services/structural-mechanical-piping.php' => 'Structural, Mechanical & Piping',
    'services/instrumentation-electrical.php'   => 'Instrumentation & Electrical',
    'services/railroad.php'                     => 'Railroad',
  ),
  'Industries' => array(
    'industries/index.php'            => 'Industries (overview)',
    'industries/mining.php'           => 'Mining & Minerals',
    'industries/power-renewables.php' => 'Power & Renewables',
    'industries/oil-gas.php'          => 'Oil, Gas & Chemicals',
    'industries/water-other.php'      => 'Water & Other',
  ),
  'Other pages' => array(
    'projects/index.php'             => 'Projects',
    'careers.php'                    => 'Careers',
    'contact.php'                    => 'Contact',
    'resources/literature-press.php' => 'Literature & Press',
    'terms.php'                      => 'Terms',
  ),
);
function pageLabel($key, $PAGES) {
  foreach ($PAGES as $grp => $items) {
    if (isset($items[$key])) return $items[$key];
  }
  return $key ?: '(unknown page)';
}
$STATUSES = array('open' => 'Open', 'agreed' => 'Agreed', 'done' => 'Done', 'wont' => "Won't do");
$TYPES    = array('bug' => 'Bug / broken', 'copy' => 'Copy edit', 'design' => 'Design / layout', 'idea' => 'Idea / suggestion');

/* ---- storage helpers (flock-guarded JSON) ---- */
function loadItems($STORE) {
  if (!file_exists($STORE)) return array();
  $fh = fopen($STORE, 'r'); if (!$fh) return array();
  flock($fh, LOCK_SH);
  $raw = stream_get_contents($fh);
  flock($fh, LOCK_UN); fclose($fh);
  $d = json_decode($raw, true);
  return is_array($d) ? $d : array();
}
function saveItems($STORE, $items) {
  $fh = fopen($STORE, 'c+'); if (!$fh) return false;
  flock($fh, LOCK_EX);
  ftruncate($fh, 0); rewind($fh);
  fwrite($fh, json_encode($items, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
  fflush($fh); flock($fh, LOCK_UN); fclose($fh);
  return true;
}
function newId() { return 'fb_' . bin2hex(random_bytes(6)); }
function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

/* ---- POST actions ---- */
$notice = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = isset($_POST['action']) ? $_POST['action'] : '';

  if ($action === 'add') {
    $name    = trim(substr((string)$_POST['name'], 0, 60));
    $pageKey = (string)$_POST['page'];
    $where   = trim(substr((string)$_POST['where'], 0, 140));
    $type    = isset($TYPES[$_POST['type']]) ? $_POST['type'] : 'idea';
    $comment = trim(substr((string)$_POST['comment'], 0, 4000));
    $validPage = false;
    foreach ($PAGES as $grp => $items) { if (isset($items[$pageKey])) { $validPage = true; break; } }
    if ($name === '' || $comment === '' || !$validPage) {
      $notice = 'Feedback needs your name, a page, and a comment.';
    } else {
      /* screenshots */
      $imgs = array();
      if (!empty($_FILES['shots']) && is_array($_FILES['shots']['name'])) {
        $n = min(count($_FILES['shots']['name']), $MAX_IMGS_PER_COMMENT);
        for ($i = 0; $i < $n; $i++) {
          if ($_FILES['shots']['error'][$i] !== UPLOAD_ERR_OK) continue;
          if ($_FILES['shots']['size'][$i] > $MAX_IMG_BYTES) continue;
          $tmp = $_FILES['shots']['tmp_name'][$i];
          $info = @getimagesize($tmp);
          if (!$info) continue;
          $extMap = array(IMAGETYPE_JPEG => 'jpg', IMAGETYPE_PNG => 'png', IMAGETYPE_GIF => 'gif', IMAGETYPE_WEBP => 'webp');
          if (!isset($extMap[$info[2]])) continue;
          $fname = newId() . '.' . $extMap[$info[2]];
          if (move_uploaded_file($tmp, $UPLOAD_DIR . '/' . $fname)) { $imgs[] = $fname; }
        }
      }
      $items = loadItems($STORE);
      $items[] = array(
        'id' => newId(), 'at' => time(), 'name' => $name, 'page' => $pageKey,
        'where' => $where, 'type' => $type, 'comment' => $comment,
        'imgs' => $imgs, 'status' => 'open',
      );
      saveItems($STORE, $items);
      /* redirect (PRG) so refresh doesn't repost */
      header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?') . '?saved=1#board');
      exit;
    }
  }

  if ($action === 'status') {
    $id = (string)$_POST['id'];
    $st = isset($STATUSES[$_POST['status']]) ? $_POST['status'] : 'open';
    $items = loadItems($STORE);
    foreach ($items as &$it) { if ($it['id'] === $id) { $it['status'] = $st; } }
    unset($it);
    saveItems($STORE, $items);
    header('Content-Type: application/json'); echo '{"ok":true}'; exit;
  }
}

$items = loadItems($STORE);
$prefPage = isset($_GET['page']) ? (string)$_GET['page'] : '';
/* map a raw URI (from the widget) to a page key */
if ($prefPage !== '') {
  $clean = ltrim(parse_url($prefPage, PHP_URL_PATH), '/');
  if ($clean === '' || $clean === 'index.php') $clean = 'index.php';
  $found = '';
  foreach ($PAGES as $grp => $ps) { foreach ($ps as $k => $lbl) { if ($k === $clean) { $found = $k; break 2; } } }
  $prefPage = $found;
}
if (isset($_GET['saved'])) $notice = 'Thanks — feedback saved.';

/* counts for the header */
$openCount = 0; foreach ($items as $it) { if ($it['status'] === 'open') $openCount++; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex,nofollow">
<title>GBI Website Draft — Feedback Board</title>
<style>
  :root{--ink:#16222C;--soft:#5a6770;--line:#d8d4c9;--bg:#f6f4ee;--card:#fff;--accent:#E0531D;--green:#2E7D49}
  *{box-sizing:border-box}
  body{margin:0;font-family:"Segoe UI",system-ui,Arial,sans-serif;background:var(--bg);color:var(--ink)}
  header{background:var(--ink);color:#f0ede8;padding:16px 22px}
  header h1{margin:0;font-size:18px}
  header .sub{font-size:12px;opacity:.75;margin-top:3px}
  .wrap{max-width:1000px;margin:0 auto;padding:18px}
  .card{background:var(--card);border:1px solid var(--line);border-radius:8px;padding:16px 18px;margin-bottom:18px}
  h2{font-size:14px;text-transform:uppercase;letter-spacing:.06em;color:var(--soft);margin:0 0 12px}
  label{display:block;font-size:12px;font-weight:600;margin:10px 0 4px}
  input[type=text],select,textarea{width:100%;padding:8px 10px;border:1px solid var(--line);border-radius:6px;font:inherit;font-size:14px;background:#fff}
  textarea{min-height:90px;resize:vertical}
  .row{display:flex;gap:12px;flex-wrap:wrap}
  .row>div{flex:1;min-width:200px}
  .btn{display:inline-block;background:var(--accent);color:#fff;border:none;border-radius:6px;padding:10px 22px;font-size:14px;font-weight:700;cursor:pointer;margin-top:14px}
  .btn:hover{filter:brightness(1.07)}
  .notice{background:#dcfce7;border:1px solid var(--green);color:#1d5731;padding:9px 13px;border-radius:6px;font-size:13px;margin-bottom:14px}
  .notice.err{background:#fee2e2;border-color:#dc2626;color:#7f1d1d}
  .drop{border:1.5px dashed var(--line);border-radius:6px;padding:12px;text-align:center;font-size:12.5px;color:var(--soft);cursor:pointer;margin-top:4px}
  .drop.has{border-color:var(--green);color:var(--green)}
  .thumbs{display:flex;gap:8px;margin-top:8px;flex-wrap:wrap}
  .thumbs img{height:64px;border-radius:4px;border:1px solid var(--line)}
  .filters{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:14px;align-items:center}
  .chip{border:1px solid var(--line);background:#fff;border-radius:20px;padding:5px 13px;font-size:12.5px;cursor:pointer;user-select:none}
  .chip.on{background:var(--ink);color:#fff;border-color:var(--ink)}
  .pgroup{margin-bottom:6px}
  .pghdr{font-size:13px;font-weight:800;letter-spacing:.04em;padding:10px 4px 6px;color:var(--ink)}
  .item{background:var(--card);border:1px solid var(--line);border-left:4px solid var(--accent);border-radius:7px;padding:11px 14px;margin-bottom:9px}
  .item.st-done{border-left-color:var(--green);opacity:.75}
  .item.st-agreed{border-left-color:#2563eb}
  .item.st-wont{border-left-color:#8B9097;opacity:.6}
  .item .top{display:flex;gap:10px;align-items:baseline;flex-wrap:wrap}
  .item .who{font-weight:700;font-size:13.5px}
  .item .meta{font-size:11.5px;color:var(--soft)}
  .badge{font-size:10px;font-weight:800;letter-spacing:.05em;text-transform:uppercase;border-radius:3px;padding:2px 6px;background:#fdecc4;color:#92500a}
  .badge.t-bug{background:#fee2e2;color:#7f1d1d}
  .badge.t-copy{background:#e0e7ff;color:#312e81}
  .badge.t-design{background:#ede9fe;color:#5b21b6}
  .item .where{font-size:12px;color:var(--soft);font-style:italic;margin-top:2px}
  .item .txt{font-size:14px;margin-top:6px;white-space:pre-wrap}
  .item .shots{display:flex;gap:8px;margin-top:8px;flex-wrap:wrap}
  .item .shots a img{height:90px;border-radius:5px;border:1px solid var(--line)}
  .item .foot{margin-top:8px;display:flex;justify-content:flex-end}
  .item select{width:auto;font-size:12px;padding:4px 8px}
  .empty{color:var(--soft);font-style:italic;font-size:13.5px;padding:14px}
  a{color:var(--accent)}
</style>
</head>
<body>
<header>
  <h1>GBI Website Draft — Feedback Board</h1>
  <div class="sub"><?php echo count($items); ?> comment<?php echo count($items) === 1 ? '' : 's'; ?> · <?php echo $openCount; ?> open · draft: phpstack-163463-6478255.cloudwaysapps.com</div>
</header>
<div class="wrap">

  <?php if ($notice): ?>
    <div class="notice<?php echo (strpos($notice, 'needs') !== false) ? ' err' : ''; ?>"><?php echo h($notice); ?></div>
  <?php endif; ?>

  <div class="card">
    <h2>Leave feedback</h2>
    <form method="post" enctype="multipart/form-data" id="fb-form">
      <input type="hidden" name="action" value="add">
      <div class="row">
        <div>
          <label>Your name</label>
          <input type="text" name="name" id="fb-name" maxlength="60" placeholder="First and last name" required>
        </div>
        <div>
          <label>Which page?</label>
          <select name="page" required>
            <?php foreach ($PAGES as $grp => $ps): ?>
              <optgroup label="<?php echo h($grp); ?>">
                <?php foreach ($ps as $k => $lbl): ?>
                  <option value="<?php echo h($k); ?>"<?php echo $k === $prefPage ? ' selected' : ''; ?>><?php echo h($lbl); ?></option>
                <?php endforeach; ?>
              </optgroup>
            <?php endforeach; ?>
          </select>
        </div>
        <div>
          <label>Type</label>
          <select name="type">
            <?php foreach ($TYPES as $k => $lbl): ?><option value="<?php echo h($k); ?>"><?php echo h($lbl); ?></option><?php endforeach; ?>
          </select>
        </div>
      </div>
      <label>Where on the page? <span style="font-weight:400;color:var(--soft)">(optional — e.g. “hero photo”, “second paragraph”)</span></label>
      <input type="text" name="where" maxlength="140">
      <label>Your comment</label>
      <textarea name="comment" required placeholder="What should change, what's broken, or what you like…"></textarea>
      <label>Screenshots <span style="font-weight:400;color:var(--soft)">(optional — up to 3; you can also paste a screenshot here with Ctrl+V)</span></label>
      <div class="drop" id="fb-drop" tabindex="0">Click to choose images, drag them here, or click here then press Ctrl+V to paste a screenshot</div>
      <input type="file" name="shots[]" id="fb-file" accept="image/png,image/jpeg,image/webp,image/gif" multiple style="display:none">
      <div class="thumbs" id="fb-thumbs"></div>
      <button class="btn" type="submit">Submit feedback</button>
    </form>
  </div>

  <div class="card" id="board">
    <h2>All feedback — grouped by page</h2>
    <div class="filters" id="filters">
      <span style="font-size:11px;font-weight:700;color:var(--soft)">STATUS:</span>
      <span class="chip on" data-f="status" data-v="">All</span>
      <?php foreach ($STATUSES as $k => $lbl): ?><span class="chip" data-f="status" data-v="<?php echo h($k); ?>"><?php echo h($lbl); ?></span><?php endforeach; ?>
      <span style="font-size:11px;font-weight:700;color:var(--soft);margin-left:10px">TYPE:</span>
      <span class="chip on" data-f="type" data-v="">All</span>
      <?php foreach ($TYPES as $k => $lbl): ?><span class="chip" data-f="type" data-v="<?php echo h($k); ?>"><?php echo h($lbl); ?></span><?php endforeach; ?>
    </div>

    <?php
    /* group items by page, in nav order */
    $byPage = array();
    foreach ($items as $it) { $byPage[$it['page']][] = $it; }
    $shown = 0;
    foreach ($PAGES as $grp => $ps):
      foreach ($ps as $pk => $plbl):
        if (empty($byPage[$pk])) continue;
        $shown++;
    ?>
      <div class="pgroup" data-page="<?php echo h($pk); ?>">
        <div class="pghdr"><?php echo h($plbl); ?> <span style="font-weight:400;color:var(--soft);font-size:11.5px">(<?php echo count($byPage[$pk]); ?>)</span></div>
        <?php foreach (array_reverse($byPage[$pk]) as $it): ?>
          <div class="item st-<?php echo h($it['status']); ?>" data-status="<?php echo h($it['status']); ?>" data-type="<?php echo h($it['type']); ?>">
            <div class="top">
              <span class="who"><?php echo h($it['name']); ?></span>
              <span class="badge t-<?php echo h($it['type']); ?>"><?php echo h($TYPES[$it['type']]); ?></span>
              <span class="meta"><?php echo date('M j, g:ia', $it['at']); ?></span>
            </div>
            <?php if ($it['where'] !== ''): ?><div class="where">📍 <?php echo h($it['where']); ?></div><?php endif; ?>
            <div class="txt"><?php echo h($it['comment']); ?></div>
            <?php if (!empty($it['imgs'])): ?>
              <div class="shots">
                <?php foreach ($it['imgs'] as $im): ?>
                  <a href="feedback-data/uploads/<?php echo h($im); ?>" target="_blank" rel="noopener"><img src="feedback-data/uploads/<?php echo h($im); ?>" alt="screenshot"></a>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
            <div class="foot">
              <select class="st-sel" data-id="<?php echo h($it['id']); ?>">
                <?php foreach ($STATUSES as $k => $lbl): ?><option value="<?php echo h($k); ?>"<?php echo $k === $it['status'] ? ' selected' : ''; ?>><?php echo h($lbl); ?></option><?php endforeach; ?>
              </select>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endforeach; ?>
    <?php if (!$shown): ?><div class="empty">No feedback yet — be the first. Use the form above.</div><?php endif; ?>
  </div>
</div>

<script>
(function(){
  /* remember the commenter's name on this browser */
  var nameIn=document.getElementById('fb-name');
  try{ var saved=localStorage.getItem('gbi_fb_name'); if(saved&&!nameIn.value) nameIn.value=saved; }catch(e){}
  document.getElementById('fb-form').addEventListener('submit',function(){ try{ localStorage.setItem('gbi_fb_name',nameIn.value); }catch(e){} });

  /* screenshot picker: click, drag-drop, or paste */
  var drop=document.getElementById('fb-drop'), file=document.getElementById('fb-file'), thumbs=document.getElementById('fb-thumbs');
  var picked=new DataTransfer();
  function refresh(){
    file.files=picked.files;
    thumbs.innerHTML='';
    Array.prototype.forEach.call(picked.files,function(f){
      var img=document.createElement('img'); img.src=URL.createObjectURL(f); thumbs.appendChild(img);
    });
    drop.classList.toggle('has',picked.files.length>0);
    drop.textContent=picked.files.length?(picked.files.length+' image'+(picked.files.length>1?'s':'')+' attached — click to add more'):'Click to choose images, drag them here, or click here then press Ctrl+V to paste a screenshot';
  }
  function addFiles(list){
    Array.prototype.forEach.call(list,function(f){
      if(!/^image\//.test(f.type)) return;
      if(picked.files.length>=3) return;
      picked.items.add(f);
    });
    refresh();
  }
  drop.addEventListener('click',function(){ file.click(); });
  file.addEventListener('change',function(){ addFiles(file.files); });
  drop.addEventListener('dragover',function(e){ e.preventDefault(); });
  drop.addEventListener('drop',function(e){ e.preventDefault(); addFiles(e.dataTransfer.files); });
  document.addEventListener('paste',function(e){
    var fs=[]; Array.prototype.forEach.call(e.clipboardData.items,function(it){ if(it.kind==='file'){ var f=it.getAsFile(); if(f) fs.push(f); } });
    if(fs.length) addFiles(fs);
  });

  /* filters */
  var f={status:'',type:''};
  document.getElementById('filters').addEventListener('click',function(e){
    var c=e.target.closest('.chip'); if(!c) return;
    f[c.dataset.f]=c.dataset.v;
    document.querySelectorAll('.chip[data-f="'+c.dataset.f+'"]').forEach(function(x){ x.classList.toggle('on',x===c); });
    document.querySelectorAll('.item').forEach(function(it){
      var ok=(!f.status||it.dataset.status===f.status)&&(!f.type||it.dataset.type===f.type);
      it.style.display=ok?'':'none';
    });
    document.querySelectorAll('.pgroup').forEach(function(g){
      var any=[...g.querySelectorAll('.item')].some(function(it){ return it.style.display!=='none'; });
      g.style.display=any?'':'none';
    });
  });

  /* status changes save immediately */
  document.querySelectorAll('.st-sel').forEach(function(sel){
    sel.addEventListener('change',function(){
      var fd=new FormData(); fd.append('action','status'); fd.append('id',sel.dataset.id); fd.append('status',sel.value);
      fetch(location.pathname,{method:'POST',body:fd}).then(function(){ location.reload(); });
    });
  });
})();
</script>
</body>
</html>
