<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Downpayment extends Model
{
    protected $table = 'downpayments';

    protected $fillable = [
        'user_id',
        'academic_year',
        'downpayment',
        'allocated_at',
    ];
}
