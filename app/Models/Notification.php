<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $primaryKey = 'notification_id';

    protected $fillable = [
        'pn_id',
        'content',
        'sent_at',
        'read_at',
    ];

    public function promissoryNote()
    {
        return $this->belongsTo(PromissoryNote::class, 'pn_id', 'pn_id');
    }
}
