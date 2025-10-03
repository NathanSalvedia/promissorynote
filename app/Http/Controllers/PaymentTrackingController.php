<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromissoryNote;


class PaymentTrackingController extends Controller
{
    public function index()
    {
        $notes = PromissoryNote::with('payments')->get();


        $totalCollected = $notes->flatMap->payments->sum('amount') + $notes->sum('down_payment');
        $avgDownPayment = $notes->avg('down_payment');
        $pendingPayments = $notes->filter(function ($note) {
            $paid = $note->payments->sum('amount') + $note->down_payment;
            return $paid < $note->amount;
        })->count();
        $overdue = $notes->filter(function ($note) {
            $paid = $note->payments->sum('amount') + $note->down_payment;
            return $note->due_date <= now()->toDateString() && $paid < $note->amount;
        })->count();

        return view('admin.payment-tracking', compact(
            'notes',
            'totalCollected',
            'avgDownPayment',
            'pendingPayments',
            'overdue'
        ));

    }




}
