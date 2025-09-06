<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $primaryKey = 'evaluation_id';
    protected $fillable = ['pn_id', 'evaluation_status', 'evaluated_date', 'approved_by_admin', 'approved_at',];

    public function promissoryNote()
    {
        return $this->belongsTo(PromissoryNote::class, 'pn_id');
    }
}
