<?php
$files = glob(__DIR__ . '/storage/framework/views/*.php');
foreach ($files as $f) {
    $content = file_get_contents($f);
    if (strpos($content, 'event-show.blade.php') !== false) {
        echo "Found: $f\n";
        exec('php -l ' . escapeshellarg($f), $output, $code);
        echo implode("\n", $output);
        break;
    }
}
