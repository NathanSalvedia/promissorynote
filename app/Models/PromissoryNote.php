<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SupportingDocument;

class PromissoryNote extends Model
{
    use HasFactory;

    protected $primaryKey = 'pn_id';
    protected $fillable = [
        'user_id', 'fullname', 'student_id', 'gender', 'course', 'department', 'phone', 'year_level', 'amount', 'reason', 'other_reason',  'academic_year',  'semester', 'down_payment', 'due_date',  'attachments', 'status', 'is_settled'
    ];


    /**
     * Get the user that owns the promissory note.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function evaluations()
    {
        return $this->hasOne(Evaluation::class, 'pn_id');
    }


    public function approval()
  {

    return $this->hasOne(Approve::class, 'pn_id', );
  }

  public function supportingDocuments()
  {
      return $this->hasMany(SupportingDocument::class, 'pn_id', 'pn_id');
  }

  public function payments()
  {
      return $this->hasMany(Payment::class, 'pn_id', 'pn_id');
  }

  public function period()
  {
      return $this->hasOne(Period::class, 'pn_id', 'pn_id');
  }


}


