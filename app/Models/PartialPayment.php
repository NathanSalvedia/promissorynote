<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartialPayment extends Model
{
    protected $table = 'partial_payments';
    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'pn_id',
        'payment_amount',
        'due_date',
    ];

    public function promissoryNote()
    {
        return $this->belongsTo(PromissoryNote::class, 'pn_id', 'pn_id');
    }
}
