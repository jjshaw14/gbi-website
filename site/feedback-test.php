<?php
// Diagnostic file — remove after debugging /feedback.php
ini_set('display_errors', '1');
error_reporting(E_ALL);
echo "<h1>PHP is running.</h1>";
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
