<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$events = App\Models\Event::count();
$tickets = App\Models\EventTicketType::count();
$registrations = App\Models\EventRegistration::count();

echo "EVENTS: $events\n";
echo "TICKETS: $tickets\n";
echo "REGISTRATIONS: $registrations\n";
