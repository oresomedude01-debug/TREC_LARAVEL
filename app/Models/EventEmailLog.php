<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventEmailLog extends Model
{
    protected $fillable = [
        'event_id',
        'registration_id',
        'template',
        'recipient_email',
        'recipient_name',
        'status',
        'error_message',
        'sent_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function registration(): BelongsTo
    {
        return $this->belongsTo(EventRegistration::class);
    }
}
