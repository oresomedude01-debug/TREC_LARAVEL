<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Find TSCC 2026 event
$tsccEvent = App\Models\Event::where('name', 'LIKE', '%TSCC 2026%')
    ->orWhere('slug', 'like', '%tscc%')
    ->orWhere('slug', '2026')
    ->first();

if (!$tsccEvent) {
    echo "❌ TSCC 2026 event not found. Cannot proceed.\n";
    exit;
}

echo "✓ Found TSCC 2026 event (ID: {$tsccEvent->id})\n";

// Get all other events
$otherEvents = App\Models\Event::where('id', '!=', $tsccEvent->id)->get();

if ($otherEvents->isEmpty()) {
    echo "✓ No other events to remove.\n";
} else {
    echo "Found " . $otherEvents->count() . " other events to remove:\n";
    foreach ($otherEvents as $event) {
        echo "  - Removing: {$event->name} (ID: {$event->id})\n";
        
        // Delete related records first
        App\Models\EventRegistration::where('event_id', $event->id)->delete();
        App\Models\EventSession::where('event_id', $event->id)->delete();
        App\Models\EventSpeaker::where('event_id', $event->id)->delete();
        App\Models\EventTicketType::where('event_id', $event->id)->delete();
        App\Models\EventSponsor::where('event_id', $event->id)->delete();
        App\Models\EventCertificate::where('event_id', $event->id)->delete();
        App\Models\EventEmailLog::where('event_id', $event->id)->delete();
        App\Models\EventMarketingCampaign::where('event_id', $event->id)->delete();
        
        // Delete event
        $event->delete();
        echo "    ✓ Deleted\n";
    }
}

// Now delete all registrations for TSCC 2026 to clear "tickets sold"
$registrationCount = App\Models\EventRegistration::where('event_id', $tsccEvent->id)->count();
if ($registrationCount > 0) {
    echo "\n🗑️  Removing {$registrationCount} registrations for TSCC 2026...\n";
    App\Models\EventRegistration::where('event_id', $tsccEvent->id)->delete();
    echo "✓ All registrations deleted\n";
} else {
    echo "✓ No registrations to remove\n";
}

// Reset ticket quantities
echo "\n🔄 Resetting ticket quantities...\n";
$ticketTypes = App\Models\EventTicketType::where('event_id', $tsccEvent->id)->get();
foreach ($ticketTypes as $ticket) {
    $ticket->quantity_sold = 0;
    $ticket->save();
    echo "✓ Reset {$ticket->name} sold count to 0\n";
}

echo "\n✅ Database cleanup completed successfully!\n";
echo "   - Kept: TSCC 2026 event and all its data\n";
echo "   - Removed: All other events and their registrations\n";
echo "   - Reset: All ticket sold counts to 0\n";
