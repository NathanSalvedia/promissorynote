<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportingDocument extends Model
{
    protected $fillable = [
        'pn_id',
        'file_name',
        'file_path',
        'document_type',
        'upload_date',
    ];

    public function promissoryNote()
    {
        return $this->belongsTo(PromissoryNote::class, 'pn_id', 'pn_id');
    }
}
