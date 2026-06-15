<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventSession extends Model
{
    protected $fillable = [
        'event_id',
        'speaker_id',
        'title',
        'description',
        'session_date',
        'start_time',
        'end_time',
        'venue_room',
        'category',
        'track',
        'display_order',
    ];

    protected $casts = [
        'session_date' => 'date',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function speaker(): BelongsTo
    {
        return $this->belongsTo(EventSpeaker::class, 'speaker_id');
    }

    // ─── Accessors ────────────────────────────────────────────────────────────

    public function getDurationAttribute(): string
    {
        if (!$this->start_time || !$this->end_time) {
            return '';
        }

        $start = Carbon::parse($this->start_time);
        $end   = Carbon::parse($this->end_time);
        $mins  = (int) $start->diffInMinutes($end);

        if ($mins >= 60) {
            $hours      = (int) floor($mins / 60);
            $remaining  = $mins % 60;
            return $hours . 'h' . ($remaining ? ' ' . $remaining . 'm' : '');
        }

        return $mins . 'm';
    }
}
