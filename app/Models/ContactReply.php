<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactReply extends Model
{
    protected $fillable = ['contact_id', 'user_id', 'subject', 'body', 'email_sent', 'email_error'];

    protected $casts = ['email_sent' => 'boolean'];

    public function inquiry()
    {
        return $this->belongsTo(ContactInquiry::class, 'contact_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
