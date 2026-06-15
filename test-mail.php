<?php

// Bootstrap Laravel properly using artisan-style boot
define('LARAVEL_START', microtime(true));

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;

$host       = config('mail.mailers.smtp.host');
$port       = config('mail.mailers.smtp.port');
$encryption = config('mail.mailers.smtp.encryption');
$username   = config('mail.mailers.smtp.username');
$from       = config('mail.from.address');

echo "SMTP Host      : $host\n";
echo "SMTP Port      : $port\n";
echo "SMTP Encryption: $encryption\n";
echo "SMTP Username  : $username\n";
echo "From Address   : $from\n\n";

try {
    Mail::raw(
        'Test email from TREC Laravel at ' . date('Y-m-d H:i:s') . '. SMTP is working!',
        function ($message) {
            $message->to('tscc@trecnigeria.com')
                    ->subject('TREC SMTP Test - ' . date('H:i:s'));
        }
    );
    echo "SUCCESS: Email sent! Check your inbox.\n";
} catch (\Exception $e) {
    echo "FAILED: " . $e->getMessage() . "\n";
}
