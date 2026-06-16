<?php
require 'vendor/autoload.php';

// Load Laravel app
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Event;
use App\Models\EventTicketType;

// Get TSCC 2026 event
$event = Event::where('name', 'like', '%TSCC%')->orWhere('name', 'like', '%2026%')->first();

$benefitsMap = [
    // 1 Day VIP (Early Bird)
    '1 Day    VIP (Early Bird)' => [
        'Access to all Day 1 sessions',
        'Priority seating in conference hall',
        'VIP lounge access',
        'Complimentary breakfast & refreshments',
        'Exclusive networking session',
        'Branded conference materials'
    ],
    // 2 Days VIP (Early Bird)
    '2 Days VIP (Early Bird)' => [
        'Access to all Day 1 & Day 2 sessions',
        'Priority seating in conference hall',
        'VIP lounge access with premium refreshments',
        'Complimentary meals (breakfast, lunch, dinner)',
        '2x Exclusive networking sessions',
        'Premium branded conference materials',
        'Digital course materials & recordings',
        'Certificate of participation'
    ],
    // 1 Day VIP (Standard)
    '1 Day VIP (Standard)' => [
        'Access to all Day 1 sessions',
        'Priority seating in conference hall',
        'VIP lounge access',
        'Complimentary breakfast & refreshments',
        'Exclusive networking session',
        'Branded conference materials'
    ],
    // 2 Days VIP (Standard)
    '2 Days VIP (Standard)' => [
        'Access to all Day 1 & Day 2 sessions',
        'Priority seating in conference hall',
        'VIP lounge access with premium refreshments',
        'Complimentary meals (breakfast, lunch, dinner)',
        '2x Exclusive networking sessions',
        'Premium branded conference materials',
        'Digital course materials & recordings',
        'Certificate of participation'
    ],
    // 1 Day Regular (Early Bird)
    '1 Day Regular (Early Bird)' => [
        'Access to all Day 1 sessions',
        'General admission seating',
        'Complimentary breakfast & refreshments',
        'Networking opportunities',
        'Branded conference materials',
        'Certificate of participation'
    ],
    // 2 Day Regular (Early Bird)
    '2 Day Regular (Early Bird)' => [
        'Access to all Day 1 & Day 2 sessions',
        'General admission seating',
        'Complimentary meals & refreshments',
        'Multiple networking opportunities',
        'Comprehensive conference materials',
        'Digital recordings access',
        'Certificate of participation'
    ],
    // 1 Day Regular (Standard)
    '1 Day Regular (Standard)' => [
        'Access to all Day 1 sessions',
        'General admission seating',
        'Complimentary breakfast & refreshments',
        'Networking opportunities',
        'Branded conference materials',
        'Certificate of participation'
    ],
    // 2 Day Regular (standard)
    '2 Day Regular (standard)' => [
        'Access to all Day 1 & Day 2 sessions',
        'General admission seating',
        'Complimentary meals & refreshments',
        'Multiple networking opportunities',
        'Comprehensive conference materials',
        'Digital recordings access',
        'Certificate of participation'
    ]
];

echo "Adding benefits to ticket types...\n";
echo "════════════════════════════════════════\n\n";

$tickets = EventTicketType::where('event_id', $event->id)
    ->orderBy('display_order')
    ->get();

$updated = 0;

foreach ($tickets as $ticket) {
    $ticketName = trim($ticket->name);
    
    if (isset($benefitsMap[$ticketName])) {
        $benefits = json_encode($benefitsMap[$ticketName]);
        $ticket->update(['benefits' => $benefits]);
        $updated++;
        
        echo "✓ Updated: " . $ticket->name . "\n";
        foreach ($benefitsMap[$ticketName] as $benefit) {
            echo "    • " . $benefit . "\n";
        }
        echo "\n";
    } else {
        echo "✗ No benefits found for: " . $ticket->name . "\n";
    }
}

echo "════════════════════════════════════════\n";
echo "✓ Successfully updated $updated ticket types with benefits\n";
?>
