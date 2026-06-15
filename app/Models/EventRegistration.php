<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EventRegistration extends Model
{
    protected $fillable = [
        'event_id',
        'ticket_type_id',
        'registration_number',
        'first_name',
        'last_name',
        'email',
        'phone',
        'organization',
        'profession',
        'custom_fields',
        'payment_status',
        'amount_paid',
        'qr_token',
        'checked_in',
        'checked_in_at',
        'checked_in_by',
        'status',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'ref_code',
        'waitlist_notified_at',
    ];

    protected $casts = [
        'custom_fields'         => 'array',
        'checked_in'            => 'boolean',
        'checked_in_at'         => 'datetime',
        'waitlist_notified_at'  => 'datetime',
        'amount_paid'           => 'decimal:2',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function ticketType(): BelongsTo
    {
        return $this->belongsTo(EventTicketType::class, 'ticket_type_id');
    }

    public function checkedInByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'checked_in_by');
    }

    public function certificate(): HasOne
    {
        return $this->hasOne(EventCertificate::class, 'registration_id');
    }

    // ─── Accessors ────────────────────────────────────────────────────────────

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // ─── Static Helpers ───────────────────────────────────────────────────────

    /**
     * Generate a unique, human-readable registration number.
     * Example output: TREC26-000245
     */
    public static function generateRegistrationNumber(Event $event): string
    {
        $prefix = strtoupper(
            substr(preg_replace('/[^a-zA-Z]/', '', $event->name), 0, 4)
        );
        $year  = substr($event->slug, -2);
        $count = static::where('event_id', $event->id)->count() + 1;

        return $prefix . $year . '-' . str_pad((string) $count, 6, '0', STR_PAD_LEFT);
    }

    /**
     * Generate a cryptographically signed QR token tied to the registration number.
     */
    public static function generateQrToken(string $registrationNumber): string
    {
        return hash_hmac(
            'sha256',
            $registrationNumber . microtime(true),
            config('app.key')
        );
    }
}
