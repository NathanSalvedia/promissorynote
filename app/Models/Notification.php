<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $primaryKey = 'notification_id';

    protected $fillable = [
        'user_id',
        'pn_id',
        'content',
        'sent_at',
        'read_at',
        'is_read',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function promissoryNote()
    {
        return $this->belongsTo(PromissoryNote::class, 'pn_id', 'pn_id');
    }
}
