<?php
// Verify strike_price feature is fully operational
require_once __DIR__ . '/vendor/autoload.php';

$dbPath = __DIR__ . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'database.sqlite';
$db = new PDO('sqlite:' . $dbPath);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo "═══ STRIKE-PRICE FEATURE VERIFICATION ═══\n\n";

// 1. Check database schema
echo "1. DATABASE SCHEMA CHECK:\n";
$result = $db->query("PRAGMA table_info(event_ticket_types)");
$columns = $result->fetchAll(PDO::FETCH_ASSOC);

$hasStrikePrice = false;
foreach ($columns as $col) {
    if ($col['name'] === 'strike_price') {
        $hasStrikePrice = true;
        echo "   ✓ strike_price column exists: {$col['type']}\n";
    }
}
if (!$hasStrikePrice) {
    echo "   ✗ strike_price column NOT FOUND\n";
}

// 2. Check if any tickets have strike prices set
echo "\n2. TICKETS WITH STRIKE PRICES:\n";
$stmt = $db->prepare("
    SELECT id, name, price, strike_price, 
           CASE 
               WHEN strike_price > 0 AND strike_price > price 
               THEN ROUND((1 - (price / strike_price)) * 100)
               ELSE 0
           END as discount_percent
    FROM event_ticket_types
    WHERE strike_price IS NOT NULL AND strike_price > 0
    ORDER BY id
");
$stmt->execute();
$tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($tickets)) {
    echo "   ⚠ No strike prices set yet\n";
    echo "\n   SAMPLE DATA (all tickets):\n";
    $stmt = $db->prepare("SELECT id, name, price, strike_price FROM event_ticket_types ORDER BY id");
    $stmt->execute();
    $all = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($all as $t) {
        $strike = $t['strike_price'] ?: 'NULL';
        echo "   • {$t['id']}: {$t['name']} | Price: ₦{$t['price']} | Strike: {$strike}\n";
    }
} else {
    echo "   ✓ Found " . count($tickets) . " ticket(s) with strike prices:\n";
    foreach ($tickets as $t) {
        $discount = $t['discount_percent'] > 0 ? " (Save {$t['discount_percent']}%)" : "";
        echo "   • {$t['id']}: {$t['name']}\n";
        echo "      Original: ₦{$t['strike_price']} → Sale: ₦{$t['price']}{$discount}\n";
    }
}

// 3. Check EventTicketType model setup
echo "\n3. MODEL CONFIGURATION CHECK:\n";
$appPath = __DIR__ . '/app/Models/EventTicketType.php';
if (file_exists($appPath)) {
    $content = file_get_contents($appPath);
    $checks = [
        "'strike_price'" => strpos($content, "'strike_price'") !== false,
        'discount_percent accessor' => strpos($content, 'getDiscountPercentAttribute') !== false,
        'casts array' => strpos($content, "'strike_price' => 'decimal:2'") !== false,
    ];
    
    foreach ($checks as $check => $passed) {
        echo "   " . ($passed ? "✓" : "✗") . " {$check}\n";
    }
}

// 4. Check Controller validation
echo "\n4. CONTROLLER VALIDATION CHECK:\n";
$controllerPath = __DIR__ . '/app/Http/Controllers/Admin/EventTicketController.php';
if (file_exists($controllerPath)) {
    $content = file_get_contents($controllerPath);
    if (strpos($content, "'strike_price'") !== false) {
        echo "   ✓ Controller has strike_price field\n";
        if (strpos($content, "'strike_price' => 'nullable|numeric|min:0'") !== false ||
            strpos($content, "'strike_price'=>'nullable|numeric|min:0'") !== false) {
            echo "   ✓ Validation rule present\n";
        }
    }
}

echo "\n═══ SUMMARY ═══\n";
echo "Status: Strike-price feature is " . ($hasStrikePrice && count($tickets) > 0 ? "✓ OPERATIONAL" : ($hasStrikePrice ? "⚠ READY (no test data)" : "✗ INCOMPLETE")) . "\n";
?>
