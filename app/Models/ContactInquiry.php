<?php

namespace App\Models;

use App\Models\Concerns\ResolvesPrimaryKey;
use Illuminate\Database\Eloquent\Model;

class ContactInquiry extends Model
{
    use ResolvesPrimaryKey;

    const CREATED_AT = 'cre_datetime';
    const UPDATED_AT = 'updated_at';

    const STATUSES = [
        'pending' => 'Pending',
        'replied' => 'Replied',
        'closed'  => 'Closed',
    ];

    protected $table = 'tbl_contact_det';

    protected $fillable = ['cus_name', 'email', 'mobi_num', 'message', 'status', 'is_read', 'replied_at'];

    protected $casts = [
        'is_read'    => 'boolean',
        'replied_at' => 'datetime',
    ];

    public function replies()
    {
        return $this->hasMany(ContactReply::class, 'contact_id')->orderBy('created_at');
    }

    public function getStatusLabelAttribute()
    {
        $status = $this->status ?: 'pending';
        return isset(self::STATUSES[$status]) ? self::STATUSES[$status] : ucfirst($status);
    }
}
