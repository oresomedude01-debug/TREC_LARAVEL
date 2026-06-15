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

// 1. VIP Ticket
$vip = $event->ticketTypes()->where('type', 'vip')->first();
if (!$vip) {
    $vip = new App\Models\EventTicketType();
    $vip->event_id = $event->id;
    $vip->type = 'vip';
    $vip->name = 'VIP Pass';
    $vip->description = 'Premium experience with exclusive access.';
    $vip->price = 150000;
    $vip->currency = 'NGN';
    $vip->is_active = true;
    $vip->display_order = 1;
}
$vip->benefits = [
    "Full access to all keynote and breakout sessions",
    "Speaker meet and greet access",
    "Reserved front-row seating",
    "Exclusive VIP networking luncheon",
    "Conference materials and digital workbook",
    "Premium badge and fast-track registration",
    "Printed Certificate of Participation"
];
$vip->save();

// 2. Standard Ticket
$standard = $event->ticketTypes()->where('type', 'standard')->first();
if (!$standard) {
    $standard = new App\Models\EventTicketType();
    $standard->event_id = $event->id;
    $standard->type = 'standard';
    $standard->name = 'Standard Pass';
    $standard->price = 75000;
    $standard->currency = 'NGN';
    $standard->is_active = true;
    $standard->display_order = 3;
}
$standardBenefits = [
    "Full access to all keynote presentations",
    "Entry to breakout sessions and workshops",
    "Conference materials and digital workbook",
    "Access to the general networking reception",
    "Printed Certificate of Participation"
];
$standard->benefits = $standardBenefits;
$standard->save();

// 3. Early Bird Ticket
$earlyBird = $event->ticketTypes()->where('type', 'early_bird')->first();
if (!$earlyBird) {
    $earlyBird = new App\Models\EventTicketType();
    $earlyBird->event_id = $event->id;
    $earlyBird->type = 'early_bird';
    $earlyBird->name = 'Early Bird Pass';
    $earlyBird->price = 50000;
    $earlyBird->currency = 'NGN';
    $earlyBird->is_active = true;
    $earlyBird->sales_end = now()->addDays(14);
    $earlyBird->display_order = 2;
}
$earlyBird->benefits = $standardBenefits; // Same package as Standard
$earlyBird->save();

// 4. Virtual Ticket
$virtual = $event->ticketTypes()->where('type', 'virtual')->first();
if (!$virtual) {
    $virtual = new App\Models\EventTicketType();
    $virtual->event_id = $event->id;
    $virtual->type = 'virtual';
    $virtual->name = 'Virtual Pass';
    $virtual->description = 'Attend from anywhere in the world.';
    $virtual->price = 25000;
    $virtual->currency = 'NGN';
    $virtual->is_active = true;
    $virtual->display_order = 4;
}
$virtual->benefits = [
    "Live-stream access to all keynote presentations",
    "Virtual entry to selected breakout sessions",
    "Downloadable digital workbook",
    "Digital Certificate of Participation"
];
$virtual->save();

echo "Successfully updated tickets and packages!\n";
