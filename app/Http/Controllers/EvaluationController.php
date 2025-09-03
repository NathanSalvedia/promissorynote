<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;

class EvaluationController extends Controller
{
    public function approvedByAdmin($id)
    {
    $evaluation = Evaluation::findOrFail($id);
    $evaluation->approved_by_admin = true;
    $evaluation->approved_at = now();
    $evaluation->save();


    $promissoryNote = $evaluation->promissoryNote;
     if ($promissoryNote) {
        $promissoryNote->approved_by_admin = 1;
        $promissoryNote->approved_at = now();
        $promissoryNote->status = 'approved';
        $promissoryNote->save();
    }

    return response()->json(['message' => 'Evaluation and promissory note approved successfully.']);
    }
}
