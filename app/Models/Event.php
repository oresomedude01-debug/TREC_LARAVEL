<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'theme',
        'slug',
        'status',
        'short_description',
        'full_description',
        'objectives',
        'target_audience',
        'venue_name',
        'venue_address',
        'google_maps_url',
        'venues',
        'dates',
        'event_date',
        'end_date',
        'start_time',
        'end_time',
        'banner_image',
        'logo_image',
        'social_share_image',
        'email_header_image',
        'registration_form_fields',
    ];

    protected $casts = [
        'objectives'               => 'array',
        'registration_form_fields' => 'array',
        'venues'                   => 'array',
        'dates'                    => 'array',
        'event_date'               => 'date',
        'end_date'                 => 'date',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    public function speakers(): HasMany
    {
        return $this->hasMany(EventSpeaker::class)->orderBy('display_order');
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(EventSession::class)
            ->orderBy('session_date')
            ->orderBy('start_time');
    }

    public function ticketTypes(): HasMany
    {
        return $this->hasMany(EventTicketType::class)->orderBy('display_order');
    }

    public function sponsors(): HasMany
    {
        return $this->hasMany(EventSponsor::class)
            ->orderBy('tier')
            ->orderBy('display_order');
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function marketingCampaigns(): HasMany
    {
        return $this->hasMany(EventMarketingCampaign::class);
    }

    public function emailLogs(): HasMany
    {
        return $this->hasMany(EventEmailLog::class);
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(EventCertificate::class);
    }

    // ─── Accessors ────────────────────────────────────────────────────────────

    public function getPublicUrlAttribute(): string
    {
        return url('/tscc/' . $this->slug);
    }

    public function getTotalRevenueAttribute(): float
    {
        return (float) $this->registrations()
            ->where('payment_status', 'paid')
            ->sum('amount_paid');
    }

    public function getTotalCheckedInAttribute(): int
    {
        return $this->registrations()
            ->where('checked_in', true)
            ->count();
    }

    public function getStatusBadgeColorAttribute(): string
    {
        return match ($this->status) {
            'published'            => 'blue',
            'registration_open'    => 'green',
            'registration_closed'  => 'yellow',
            'completed'            => 'purple',
            'archived'             => 'gray',
            default                => 'slate',
        };
    }
}
