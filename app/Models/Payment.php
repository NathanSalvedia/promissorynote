<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'pn_id',
        'amount',
        'payment_date',
        'remarks',
    ];

    public function promissoryNote()
    {
        return $this->belongsTo(PromissoryNote::class, 'pn_id', 'pn_id');
    }
}
