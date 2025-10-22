<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Services\SmsService;

class EvaluationController extends Controller
{
    public function approvedByAdmin($id, SmsService $smsService)
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

            // Send SMS notification using promissory note's phone
            $phone = $promissoryNote->phone;
            // Convert to international format if needed
            if (str_starts_with($phone, '0')) {
                $phone = '63' . substr($phone, 1);
            }
            $smsService->send(
                $phone,
                "Good day! This is from St. Peter's College. I would like to inform you that your promissory form is approved. Kindly proceed to Accounting Window 3 for further assistance and processing. Thank you!"
            );
        }

        return response()->json(['message' => 'Evaluation and promissory note approved successfully.']);
    }
}
