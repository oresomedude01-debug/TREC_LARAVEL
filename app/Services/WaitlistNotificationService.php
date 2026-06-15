<?php

namespace App\Services;

use App\Mail\WaitlistTicketAvailableMail;
use App\Models\EventRegistration;
use App\Models\EventTicketType;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class WaitlistNotificationService
{
    /**
     * Send notifications to all waitlisted users for a specific ticket type.
     * 
     * @param EventTicketType $ticketType
     * @return int Number of notifications sent
     */
    public function notifyWaitlistedUsers(EventTicketType $ticketType): int
    {
        // Get all waitlisted users for this ticket type who haven't been notified yet
        $waitlistedUsers = EventRegistration::where('event_id', $ticketType->event_id)
            ->where('ticket_type_id', $ticketType->id)
            ->where('status', 'waitlisted')
            ->whereNull('waitlist_notified_at')
            ->get();

        $notificationCount = 0;

        foreach ($waitlistedUsers as $registration) {
            try {
                Mail::send(new WaitlistTicketAvailableMail(
                    $ticketType->event,
                    $ticketType,
                    $registration->first_name,
                    $registration->email
                ));

                // Mark as notified
                $registration->update(['waitlist_notified_at' => now()]);
                $notificationCount++;

                Log::info("Waitlist notification sent to {$registration->email} for {$ticketType->name}");
            } catch (\Exception $e) {
                Log::error("Failed to send waitlist notification to {$registration->email}: {$e->getMessage()}");
            }
        }

        return $notificationCount;
    }

    /**
     * Check if a ticket has just become on sale and notify waitlisted users.
     * 
     * @param EventTicketType $ticketType
     * @param EventTicketType|null $originalTicket Original state before update
     * @return bool True if notifications were sent
     */
    public function checkAndNotifyIfOnSale(EventTicketType $ticketType, ?EventTicketType $originalTicket = null): bool
    {
        // Check if ticket is now on sale
        if (!$ticketType->is_on_sale) {
            return false;
        }

        // If we have original ticket data, check if it was NOT on sale before
        if ($originalTicket && $originalTicket->is_on_sale) {
            return false;
        }

        // Send notifications
        $this->notifyWaitlistedUsers($ticketType);
        return true;
    }
}
