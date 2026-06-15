<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventCertificate extends Model
{
    protected $fillable = [
        'event_id',
        'registration_id',
        'certificate_number',
        'issued_at',
        'download_token',
        'template_path',
    ];

    protected $casts = [
        'issued_at' => 'datetime',
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

    // ─── Accessors ────────────────────────────────────────────────────────────

    /**
     * Returns the public download URL for this certificate.
     */
    public function getDownloadUrlAttribute(): string
    {
        return url('/tscc/certificate/' . $this->download_token);
    }
}
