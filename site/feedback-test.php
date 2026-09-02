<?php
// Diagnostic file — remove after debugging /feedback.php
ini_set('display_errors', '1');
error_reporting(E_ALL);

// Show the debug log from feedback.php crashes.
if (isset($_GET['showlog'])) {
  header('Content-Type: text/plain; charset=UTF-8');
  $log = __DIR__ . '/feedback-data/_fb_debug.log';
  echo "Log path: $log\n";
  echo "Exists: " . (file_exists($log) ? 'yes' : 'no') . "\n";
  if (file_exists($log)) {
    echo "Size: " . filesize($log) . " bytes\n\n";
    echo "---- CONTENTS ----\n";
    echo file_get_contents($log);
  }
  exit;
}
// Clear the log for a fresh run.
if (isset($_GET['clearlog'])) {
  @unlink(__DIR__ . '/feedback-data/_fb_debug.log');
  echo "Log cleared.";
  exit;
}

// Syntax-check feedback.php: parse errors are catchable in PHP 8.
if (isset($_GET['syntax'])) {
  header('Content-Type: text/plain; charset=UTF-8');
  $target = __DIR__ . '/feedback.php';
  echo "Syntax-checking: $target\n";
  echo "Size: " . filesize($target) . " bytes\n\n";
  $src = file_get_contents($target);
  try {
    // token_get_all with TOKEN_PARSE throws ParseError on invalid syntax
    $tokens = token_get_all($src, TOKEN_PARSE);
    echo "PARSE OK — no syntax errors. " . count($tokens) . " tokens.\n";
    echo "\nThe crash is a RUNTIME issue, not a parse error.\n";
    echo "Likely causes: a fatal at include time, a class/function collision,\n";
    echo "or the request never reaches PHP (WAF, mod_security, .htaccess).\n";
  } catch (ParseError $e) {
    echo "PARSE ERROR:\n";
    echo "  Message: " . $e->getMessage() . "\n";
    echo "  Line:    " . $e->getLine() . "\n";
    $lines = explode("\n", $src);
    $ln = $e->getLine();
    echo "\nContext (lines " . max(1,$ln-3) . "-" . min(count($lines),$ln+3) . "):\n";
    for ($i = max(1,$ln-3); $i <= min(count($lines),$ln+3); $i++) {
      $marker = ($i === $ln) ? ' >> ' : '    ';
      echo $marker . str_pad($i, 4) . '| ' . $lines[$i-1] . "\n";
    }
  } catch (Throwable $e) {
    echo "OTHER ERROR: " . get_class($e) . ": " . $e->getMessage() . "\n";
  }
  exit;
}

echo "<h1>PHP is running.</h1>";
echo "<p><a href='?showlog=1'>View feedback.php crash log</a> | <a href='?clearlog=1'>Clear log</a></p>";
echo "<pre>";
echo "PHP version: " . phpversion() . "\n";
echo "Script path: " . __FILE__ . "\n";
echo "Doc root: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
echo "Cwd: " . getcwd() . "\n\n";

echo "=== Writeability check ===\n";
$here = __DIR__;
echo "Trying mkdir $here/feedback-data/... ";
$ok = @mkdir($here . '/feedback-data', 0755, true);
echo ($ok || is_dir($here . '/feedback-data')) ? "OK\n" : "FAILED\n";

echo "Trying mkdir $here/feedback-data/uploads/... ";
$ok = @mkdir($here . '/feedback-data/uploads', 0755, true);
echo ($ok || is_dir($here . '/feedback-data/uploads')) ? "OK\n" : "FAILED\n";

echo "Trying file_put_contents feedback-data/test.txt... ";
$ok = @file_put_contents($here . '/feedback-data/test.txt', 'hi');
echo ($ok !== false) ? "OK ($ok bytes)\n" : "FAILED\n";

echo "\n=== random_bytes check ===\n";
try {
  $b = bin2hex(random_bytes(6));
  echo "random_bytes ok: $b\n";
} catch (Throwable $e) {
  echo "random_bytes FAILED: " . $e->getMessage() . "\n";
}

echo "\n=== feedback.php first-line syntax check ===\n";
$src = @file_get_contents($here . '/feedback.php');
if ($src === false) {
  echo "COULD NOT READ feedback.php\n";
} else {
  echo "feedback.php size: " . strlen($src) . " bytes\n";
  echo "First 200 chars:\n" . htmlspecialchars(substr($src, 0, 200)) . "\n";
}
echo "</pre>";
