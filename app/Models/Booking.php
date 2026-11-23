<?php

namespace App\Models;

use App\Models\Concerns\ResolvesPrimaryKey;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use ResolvesPrimaryKey;

    const CREATED_AT = 'cre_datetime';
    const UPDATED_AT = 'updated_at';

    const STATUSES = [
        'pending'   => 'Pending',
        'confirmed' => 'Confirmed',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
    ];

    protected $table = 'tbl_booking_det';

    protected $fillable = [
        'cus_name', 'email', 'contact_no', 'datetime', 'service_name', 'persons', 'kids',
        'message', 'status', 'package_id', 'total_amount', 'admin_notes', 'source',
    ];

    protected $casts = [
        'total_amount' => 'float',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    /** Number of adults stored as "Persons 3" / "Persons 5 Plus" in the legacy column. */
    public function getAdultCountAttribute()
    {
        return self::parseCount($this->persons);
    }

    public function getKidCountAttribute()
    {
        return self::parseCount($this->kids);
    }

    public function getGuestCountAttribute()
    {
        return $this->adult_count + $this->kid_count;
    }

    public function getTourDateAttribute()
    {
        if (empty($this->datetime)) {
            return null;
        }
        try {
            return Carbon::parse($this->datetime);
        } catch (\Throwable $e) {
            return null;
        }
    }

    public function getStatusLabelAttribute()
    {
        $status = $this->status ?: 'pending';
        return isset(self::STATUSES[$status]) ? self::STATUSES[$status] : ucfirst($status);
    }

    public function getReferenceAttribute()
    {
        return 'BK-' . str_pad($this->getKey(), 5, '0', STR_PAD_LEFT);
    }

    public static function parseCount($value)
    {
        if ($value === null || $value === '') {
            return 0;
        }
        if (preg_match('/(\d+)/', (string) $value, $m)) {
            return (int) $m[1];
        }
        return 0;
    }

    /** Legacy format used by the public booking form ("Persons 2"). */
    public static function formatPersons($count)
    {
        $count = (int) $count;
        return 'Persons ' . max(1, $count);
    }
}
