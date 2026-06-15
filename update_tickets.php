<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$event = App\Models\Event::where('slug', '2026')->first();

if (!$event) {
    echo "Event not found.\n";
    exit;
}

// Ensure VIP ticket exists
$vip = clone $event->ticketTypes()->first();
$vip = $event->ticketTypes()->where('type', 'vip')->first();
if (!$vip) {
    $vip = new App\Models\EventTicketType();
    $vip->event_id = $event->id;
    $vip->type = 'vip';
    $vip->name = 'VIP Pass';
    $vip->description = 'The ultimate TSCC experience with exclusive access.';
    $vip->price = 150000;
    $vip->currency = 'NGN';
    $vip->is_active = true;
    $vip->display_order = 1;
}
$vip->benefits = [
    "All benefits of the Standard Ticket",
    "Exclusive Meet & Greet with keynote speakers",
    "Reserved front-row seating at all main sessions",
    "VIP networking luncheon with TSCC founders",
    "Complimentary professional headshot session",
    "Fast-track registration and premium badge",
    "Access to the VIP lounge with refreshments"
];
$vip->save();
echo "Updated VIP ticket benefits.\n";

// Ensure Standard ticket exists
$standard = clone $event->ticketTypes()->first();
$standard = $event->ticketTypes()->where('type', 'standard')->first();
if ($standard) {
    $standard->benefits = [
        "Full access to all keynote presentations",
        "Entry to breakout sessions and workshops",
        "Conference materials and digital workbook",
        "Access to the general networking reception",
        "Certificate of Participation"
    ];
    $standard->save();
    echo "Updated Standard ticket benefits.\n";
}

// Ensure Early Bird ticket exists
$earlyBird = clone $event->ticketTypes()->first();
$earlyBird = $event->ticketTypes()->where('type', 'early_bird')->first();
if ($earlyBird) {
    $earlyBird->benefits = [
        "Full access to all keynote presentations",
        "Entry to breakout sessions and workshops",
        "Conference materials and digital workbook",
        "Access to the general networking reception",
        "Certificate of Participation",
        "Discounted price for early registration"
    ];
    $earlyBird->save();
    echo "Updated Early Bird ticket benefits.\n";
}

// Update Team Ticket if it exists
$team = clone $event->ticketTypes()->first();
$team = $event->ticketTypes()->where('type', 'team')->first();
if ($team) {
    $team->benefits = [
        "Access for up to 5 team members",
        "Full access to all keynote presentations",
        "Entry to breakout sessions and workshops",
        "Conference materials and digital workbook",
        "Access to the general networking reception",
        "Certificate of Participation for each member",
        "Special group discount applied"
    ];
    $team->save();
    echo "Updated Team ticket benefits.\n";
}

echo "All ticket packages updated successfully.\n";
