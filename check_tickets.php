<?php
require 'vendor/autoload.php';

// Load Laravel app
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Event;
use App\Models\EventTicketType;

// Get TSCC 2026 event
$event = Event::where('name', 'like', '%TSCC%')->orWhere('name', 'like', '%2026%')->first();

if (!$event) {
    echo "Event not found\n";
    exit;
}

echo "Event: " . $event->name . " (ID: " . $event->id . ")\n";
echo "────────────────────────────────────────\n\n";

$tickets = EventTicketType::where('event_id', $event->id)
    ->orderBy('display_order')
    ->get();

foreach ($tickets as $ticket) {
    echo "Ticket Type: {$ticket->name}\n";
    echo "Price: ₦" . number_format($ticket->price) . "\n";
    echo "Current Benefits:\n";
    
    if ($ticket->benefits) {
        $benefits = json_decode($ticket->benefits, true);
        if (is_array($benefits)) {
            foreach ($benefits as $benefit) {
                if (!empty($benefit)) {
                    echo "  • " . $benefit . "\n";
                }
            }
        }
    } else {
        echo "  (none)\n";
    }
    echo "\n";
}
?>
