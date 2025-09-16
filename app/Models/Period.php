<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $table = 'periods'; // Add this line

    protected $primaryKey = 'period_id';

    protected $fillable = [
        'pn_id',
        'semester',
        'academic_year',
    ];
}
