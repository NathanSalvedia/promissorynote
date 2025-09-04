<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountSubledger extends Model
{
    protected $table = 'student_account_subledger';

    protected $primaryKey = 'subledger_id';

    protected $fillable = [

        'user_id',
        'school_year',
        'semester',
        'date',
        'reference',
        'debit',
        'credit',
        'balance'
    ];
}
