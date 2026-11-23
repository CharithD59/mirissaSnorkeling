<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Package extends Model
{
    protected $fillable = [
        'name', 'slug', 'short_description', 'description', 'price', 'price_label', 'duration',
        'pickup_time', 'features', 'image', 'detail_url', 'is_active', 'show_on_home',
        'daily_capacity', 'blocked_dates', 'sort_order',
    ];

    protected $casts = [
        'price'          => 'float',
        'features'       => 'array',
        'blocked_dates'  => 'array',
        'is_active'      => 'boolean',
        'show_on_home'   => 'boolean',
        'daily_capacity' => 'integer',
        'sort_order'     => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /** Text shown in the website price badge, e.g. "$50" or "From $150". */
    public function getPriceTagAttribute()
    {
        if (!empty($this->price_label)) {
            return $this->price_label;
        }
        if ($this->price === null) {
            return null;
        }
        $formatted = floor($this->price) == $this->price
            ? number_format($this->price, 0)
            : number_format($this->price, 2);
        return '$' . $formatted;
    }

    public function isDateBlocked($date)
    {
        $date = Carbon::parse($date)->toDateString();
        return in_array($date, (array) $this->blocked_dates, true);
    }

    /** Guests already booked (non-cancelled) for this package on a date. */
    public function bookedGuestsOn($date, $ignoreBookingId = null)
    {
        $date = Carbon::parse($date)->toDateString();
        $query = Booking::query()
            ->where(function ($q) {
                $q->where('package_id', $this->id)->orWhere('service_name', $this->name);
            })
            ->where(DB::raw('DATE(`datetime`)'), $date)
            ->where(function ($q) {
                $q->whereNull('status')->orWhere('status', '!=', 'cancelled');
            });

        if ($ignoreBookingId) {
            $query->where((new Booking)->getKeyName(), '!=', $ignoreBookingId);
        }

        return $query->get()->sum(function ($booking) {
            return $booking->guest_count;
        });
    }

    /**
     * Returns null when the package can take the booking, otherwise a human readable reason.
     */
    public function availabilityError($date, $guests, $ignoreBookingId = null)
    {
        if (!$this->is_active) {
            return $this->name . ' is currently not available for booking.';
        }
        if (empty($date)) {
            return null;
        }
        if ($this->isDateBlocked($date)) {
            return $this->name . ' is fully booked / unavailable on ' . Carbon::parse($date)->format('d M Y') . '. Please choose another date.';
        }
        if ($this->daily_capacity) {
            $remaining = $this->daily_capacity - $this->bookedGuestsOn($date, $ignoreBookingId);
            if ($guests > $remaining) {
                return $remaining > 0
                    ? 'Only ' . $remaining . ' place(s) left for ' . $this->name . ' on ' . Carbon::parse($date)->format('d M Y') . '.'
                    : $this->name . ' is fully booked on ' . Carbon::parse($date)->format('d M Y') . '. Please choose another date.';
            }
        }
        return null;
    }
}
