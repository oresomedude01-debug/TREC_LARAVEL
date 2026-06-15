<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventSponsor extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'logo',
        'website_url',
        'tier',
        'display_order',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    // ─── Accessors ────────────────────────────────────────────────────────────

    public function getTierLabelAttribute(): string
    {
        return ucfirst($this->tier) . ' Sponsor';
    }

    public function getTierColorAttribute(): string
    {
        return match ($this->tier) {
            'platinum'  => 'slate',
            'gold'      => 'yellow',
            'silver'    => 'gray',
            'bronze'    => 'orange',
            default     => 'blue',
        };
    }
}
