<?php
require 'vendor/autoload.php';

// Load Laravel app
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    $columns = DB::getSchemaBuilder()->getColumns('event_ticket_types');
    
    echo "✓ event_ticket_types columns:\n";
    echo "─────────────────────────────────────\n";
    
    foreach ($columns as $col) {
        $nullable = $col['nullable'] ? '✓ nullable' : '✗ required';
        echo sprintf("%s (%s) - %s\n", $col['name'], $col['type'], $nullable);
    }
    
    echo "\n✓ Checking for strike_price column...\n";
    $hasPriceColumn = collect($columns)->where('name', 'strike_price')->count() > 0;
    
    if ($hasPriceColumn) {
        echo "✓ strike_price column exists!\n";
    } else {
        echo "✗ strike_price column NOT found\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
