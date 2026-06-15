<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EventSpeaker extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'title',
        'organization',
        'biography',
        'photo',
        'social_links',
        'is_featured',
        'display_order',
    ];

    protected $casts = [
        'social_links' => 'array',
        'is_featured'  => 'boolean',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(EventSession::class, 'speaker_id');
    }
}
