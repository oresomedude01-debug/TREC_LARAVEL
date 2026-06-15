<?php

namespace App\Console\Commands;

use App\Models\EventTicketType;
use App\Services\WaitlistNotificationService;
use Illuminate\Console\Command;

class NotifyWaitlist extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'waitlist:notify {ticket_id? : The ID of the ticket type to notify waitlist for} {--all : Notify all tickets that are on sale}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications to waitlisted users when their tickets go on sale';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $service = new WaitlistNotificationService();

        if ($this->option('all')) {
            // Notify for all tickets that are on sale
            $tickets = EventTicketType::where('is_active', true)
                ->where('sales_start', '<=', now())
                ->where(function ($query) {
                    $query->whereNull('sales_end')
                        ->orWhere('sales_end', '>', now());
                })
                ->get();

            $totalSent = 0;
            foreach ($tickets as $ticket) {
                $sent = $service->notifyWaitlistedUsers($ticket);
                if ($sent > 0) {
                    $this->info("Sent {$sent} notifications for ticket: {$ticket->name}");
                    $totalSent += $sent;
                }
            }

            $this->info("Total notifications sent: {$totalSent}");
            return Command::SUCCESS;
        }

        if ($this->argument('ticket_id')) {
            $ticketId = $this->argument('ticket_id');
            $ticket = EventTicketType::findOrFail($ticketId);

            $sent = $service->notifyWaitlistedUsers($ticket);
            $this->info("Sent {$sent} notifications for ticket: {$ticket->name}");

            return Command::SUCCESS;
        }

        $this->error('Please provide a ticket_id or use --all option');
        return Command::FAILURE;
    }
}
