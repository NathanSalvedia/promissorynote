<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromissoryNote extends Model
{
    use HasFactory;

    protected $primaryKey = 'pn_id';
    protected $fillable = [
        'user_id', 'fullname', 'student_id', 'gender', 'department', 'phone', 'year_level', 'amount', 'reason', 'term', 'academic_year', 'down_payment', 'due_date', 'notes', 'attachments', 'status'
    ];
}
