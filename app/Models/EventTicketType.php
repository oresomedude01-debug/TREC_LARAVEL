<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EventTicketType extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'description',
        'price',
        'currency',
        'quantity_available',
        'quantity_sold',
        'sales_start',
        'sales_end',
        'access_type',
        'benefits',
        'is_active',
        'display_order',
        'type',
        'team_size',
    ];

    protected $casts = [
        'benefits'    => 'array',
        'is_active'   => 'boolean',
        'price'       => 'decimal:2',
        'sales_start' => 'datetime',
        'sales_end'   => 'datetime',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class, 'ticket_type_id');
    }

    // ─── Accessors ────────────────────────────────────────────────────────────

    /**
     * Returns the number of tickets still available, or null if unlimited.
     */
    public function getAvailableCountAttribute(): ?int
    {
        if (is_null($this->quantity_available)) {
            return null;
        }

        return max(0, $this->quantity_available - $this->quantity_sold);
    }

    /**
     * Returns true when all allocated tickets have been sold.
     */
    public function getIsSoldOutAttribute(): bool
    {
        if (is_null($this->quantity_available)) {
            return false;
        }

        return $this->quantity_sold >= $this->quantity_available;
    }

    /**
     * Returns true when the ticket type is active and within its sale window.
     */
    public function getIsOnSaleAttribute(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        $now = now();

        if ($this->sales_start && $now->lt($this->sales_start)) {
            return false;
        }

        if ($this->sales_end && $now->gt($this->sales_end)) {
            return false;
        }

        return true;
    }

    /**
     * Returns a human-readable string status.
     */
    public function getStatusAttribute(): string
    {
        if (!$this->is_active) return 'inactive';
        if ($this->is_sold_out) return 'sold_out';
        
        $now = now();
        if ($this->sales_start && $now->lt($this->sales_start)) return 'scheduled';
        if ($this->sales_end && $now->gt($this->sales_end)) return 'ended';
        
        return 'active';
    }

    /**
     * Returns a human-readable price string, e.g. "NGN 5,000.00" or "Free".
     */
    public function getFormattedPriceAttribute(): string
    {
        if ((float) $this->price === 0.0) {
            return 'Free';
        }

        return $this->currency . ' ' . number_format((float) $this->price, 2);
    }
}
