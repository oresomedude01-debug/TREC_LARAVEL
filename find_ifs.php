<?php
$content = file_get_contents(__DIR__ . '/resources/views/pages/event-show.blade.php');
preg_match_all('/@([a-zA-Z]+)\b/', $content, $matches);
$counts = array_count_values($matches[1]);
print_r($counts);
