<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Find the correct event by theme
$targetEvent = App\Models\Event::where('theme', 'LIKE', '%From Fragmentation to a School That Works%')->first();

if (!$targetEvent) {
    // Try by slug
    $targetEvent = App\Models\Event::where('slug', '2026')->first();
}

if (!$targetEvent) {
    // Try finding by name
    $targetEvent = App\Models\Event::where('name', 'LIKE', '%TSCC%')->first();
}

if (!$targetEvent) {
    echo "❌ Could not find the target event!\n";
    exit;
}

echo "✓ Found target event:\n";
echo "  - ID: {$targetEvent->id}\n";
echo "  - Name: {$targetEvent->name}\n";
echo "  - Theme: {$targetEvent->theme}\n\n";

// Step 1: Delete ALL registrations/ticket sales for ALL events
echo "🗑️  Deleting all ticket sales records (registrations)...\n";
$totalRegistrationsDeleted = App\Models\EventRegistration::count();
if ($totalRegistrationsDeleted > 0) {
    App\Models\EventRegistration::truncate();
    echo "✓ Deleted {$totalRegistrationsDeleted} registration records\n";
} else {
    echo "✓ No registrations to delete\n";
}

// Step 2: Delete ALL ticket types for OTHER events (keep only target event tickets)
echo "\n🗑️  Deleting ticket types for other events...\n";
$otherTickets = App\Models\EventTicketType::where('event_id', '!=', $targetEvent->id)->get();
if ($otherTickets->count() > 0) {
    foreach ($otherTickets as $ticket) {
        echo "  - Deleting: {$ticket->name} (Event ID: {$ticket->event_id})\n";
        $ticket->delete();
    }
    echo "✓ Deleted " . $otherTickets->count() . " ticket types from other events\n";
} else {
    echo "✓ No tickets from other events to delete\n";
}

// Step 3: Reset quantity_sold for remaining tickets
echo "\n🔄 Resetting ticket sold counts for target event...\n";
$targetTickets = App\Models\EventTicketType::where('event_id', $targetEvent->id)->get();
foreach ($targetTickets as $ticket) {
    $ticket->quantity_sold = 0;
    $ticket->save();
    echo "✓ Reset: {$ticket->name} (sold: 0)\n";
}

// Step 4: Show final state
echo "\n📊 Final Database State:\n";
echo "─────────────────────────────────────\n";

$allEvents = App\Models\Event::all();
echo "Events: " . $allEvents->count() . "\n";
foreach ($allEvents as $event) {
    echo "  - {$event->name}\n";
}

$allTickets = App\Models\EventTicketType::all();
echo "\nTicket Types: " . $allTickets->count() . "\n";
foreach ($allTickets as $ticket) {
    echo "  - {$ticket->name} (₦" . number_format($ticket->price, 2) . ")\n";
}

$allRegistrations = App\Models\EventRegistration::all();
echo "\nRegistrations: " . $allRegistrations->count() . "\n";

echo "\n✅ Cleanup completed successfully!\n";
echo "   - All ticket sales removed\n";
echo "   - Kept only tickets for the target event\n";
echo "   - All ticket quantities reset to 0\n";
