<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventMarketingCampaign extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'channel',
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'ref_code',
        'clicks',
        'registrations',
        'revenue',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'revenue'   => 'decimal:2',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    // ─── Accessors ────────────────────────────────────────────────────────────

    /**
     * Conversion rate as a percentage string, e.g. "12.5%".
     */
    public function getConversionRateAttribute(): string
    {
        if ($this->clicks === 0) {
            return '0%';
        }

        return round(($this->registrations / $this->clicks) * 100, 1) . '%';
    }

    /**
     * Full tracking URL with UTM parameters and ref code appended.
     */
    public function getTrackingUrlAttribute(): string
    {
        $event  = $this->event;
        $params = http_build_query(array_filter([
            'utm_source'   => $this->utm_source,
            'utm_medium'   => $this->utm_medium,
            'utm_campaign' => $this->utm_campaign,
            'ref'          => $this->ref_code,
        ]));

        $base = url('/tscc/' . $event->slug);

        return $params ? $base . '?' . $params : $base;
    }
}
