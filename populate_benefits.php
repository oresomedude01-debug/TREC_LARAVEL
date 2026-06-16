<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Get the target event
$event = App\Models\Event::where('slug', '2026')->first();

if (!$event) {
    echo "❌ Event not found\n";
    exit;
}

echo "✓ Found event: {$event->name}\n\n";

// Define benefits for each ticket type
$ticketBenefits = [
    '1 Day    VIP (Early Bird)' => [
        'Premium front-row seating at all main sessions',
        'Exclusive Meet & Greet with keynote speakers',
        'VIP networking luncheon with TSCC founders',
        'Complimentary professional headshot session',
        'Fast-track registration and premium badge',
        'Access to the VIP lounge with refreshments',
        'Early Bird discount applied'
    ],
    '2 Days VIP (Early Bird)' => [
        'Premium front-row seating at all main sessions',
        'Exclusive Meet & Greet with keynote speakers',
        'VIP networking luncheon with TSCC founders',
        'Complimentary professional headshot session',
        'Fast-track registration and premium badge',
        'Access to the VIP lounge with refreshments',
        'Full 2-day access to all sessions',
        'Early Bird discount applied'
    ],
    '1 Day VIP (Standard)' => [
        'Premium front-row seating at all main sessions',
        'Exclusive Meet & Greet with keynote speakers',
        'VIP networking luncheon with TSCC founders',
        'Complimentary professional headshot session',
        'Fast-track registration and premium badge',
        'Access to the VIP lounge with refreshments'
    ],
    '2 Days VIP (Standard)' => [
        'Premium front-row seating at all main sessions',
        'Exclusive Meet & Greet with keynote speakers',
        'VIP networking luncheon with TSCC founders',
        'Complimentary professional headshot session',
        'Fast-track registration and premium badge',
        'Access to the VIP lounge with refreshments',
        'Full 2-day access to all sessions'
    ],
    '1 Day Regular (Early Bird)' => [
        'Full access to all keynote presentations',
        'Entry to breakout sessions and workshops',
        'Conference materials and digital workbook',
        'Access to the general networking reception',
        'Certificate of Participation',
        'Early Bird discount applied'
    ],
    '2 Day Regular (Early Bird)' => [
        'Full access to all keynote presentations',
        'Entry to breakout sessions and workshops',
        'Conference materials and digital workbook',
        'Access to the general networking reception',
        'Certificate of Participation',
        'Full 2-day access to all events',
        'Early Bird discount applied'
    ],
    '1 Day Regular (Standard)' => [
        'Full access to all keynote presentations',
        'Entry to breakout sessions and workshops',
        'Conference materials and digital workbook',
        'Access to the general networking reception',
        'Certificate of Participation'
    ],
    '2 Day Regular (standard)' => [
        'Full access to all keynote presentations',
        'Entry to breakout sessions and workshops',
        'Conference materials and digital workbook',
        'Access to the general networking reception',
        'Certificate of Participation',
        'Full 2-day access to all events'
    ]
];

// Update tickets with benefits
$tickets = $event->ticketTypes()->get();

foreach ($tickets as $ticket) {
    $name = trim($ticket->name);
    
    if (isset($ticketBenefits[$name])) {
        $ticket->benefits = $ticketBenefits[$name];
        $ticket->save();
        echo "✓ Updated: {$ticket->name}\n";
        foreach ($ticketBenefits[$name] as $benefit) {
            echo "  - {$benefit}\n";
        }
    } else {
        echo "⚠ No benefits mapping found for: {$ticket->name}\n";
    }
}

echo "\n✅ Benefits updated successfully!\n";
