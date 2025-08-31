<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approve extends Model
{

    protected $table = 'approve';

    protected $fillable = [
        'pn_id',
        'approval_date',
    ];

    public function approval()
    {
        return $this->hasOne(Approve::class, 'pn_id', 'pn_id');
    }
}
