<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromissoryNote;


class PaymentTrackingController extends Controller
{
    public function index()
    {
        $notes = PromissoryNote::with(['payments', 'user'])->get();

        $pendingPayments = 0;
        $overdue = 0;
        $totalCollected = 0;
        $downPayments = [];

        foreach ($notes as $note) {
            $paid = $note->payments->sum('amount') + $note->down_payment;
            $remaining = $note->amount - $paid;
            $isOverdue = $note->due_date && $note->due_date <= now()->toDateString() && $remaining > 0;

            $totalCollected += $paid;
            $downPayments[] = $note->down_payment;

            if (!$note->is_settled && $isOverdue) {
                $overdue++;
            }
            if (!$note->is_settled && !$isOverdue) {
                $pendingPayments++;
            }
        }

        $avgDownPayment = count($downPayments) ? array_sum($downPayments) / count($downPayments) : 0;

        return view('admin.payment-tracking', compact(
            'notes',
            'totalCollected',
            'avgDownPayment',
            'pendingPayments',
            'overdue'
        ));

    }




}
