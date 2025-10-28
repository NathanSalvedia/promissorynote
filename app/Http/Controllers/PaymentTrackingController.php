<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromissoryNote;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\Payment;
use App\Models\AccountSubledger;
use App\Models\User;
use App\Notifications\PaymentCompleted;

// Add Vonage classes
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;

// Add Mail classes
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentRecorded;

class PaymentTrackingController extends Controller
{
    public function index()
    {
        $notes = PromissoryNote::with(['payments', 'user'])
            ->where('status', 'approved')
            ->get();

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

        $adminId = Auth::id();

        $notifications = Notification::where(function($q) use ($adminId) {
            $q->where('user_id', $adminId)
              ->orWhereNull('user_id')
              ->orWhere('user_id', 0);
        })
        ->orderBy('sent_at', 'desc')
        ->take(10)
        ->get();

        $unreadCount = Notification::where(function($q) use ($adminId) {
            $q->where('user_id', $adminId)
              ->orWhereNull('user_id')
              ->orWhere('user_id', 0);
        })
        ->where('is_read', false)
        ->count();

        $avgDownPayment = count($downPayments) ? array_sum($downPayments) / count($downPayments) : 0;

        return view('admin.payment-tracking', compact(
            'notes',
            'totalCollected',
            'avgDownPayment',
            'pendingPayments',
            'overdue',
            'notifications',
            'unreadCount'
        ));
    }

    public function recordPayment(Request $request, $pn_id)
    {
        $note = PromissoryNote::findOrFail($pn_id);

        $subledgerEntry = AccountSubledger::where('user_id', $note->user_id)
            ->where('school_year', $note->academic_year)
            ->where('semester', '2')
            ->orderBy('date')
            ->orderBy('subledger_id')
            ->skip(2)
            ->first();

        if (!$subledgerEntry) {
            return redirect()->back()->with('error', 'Subledger entry not found.');
        }

        // Get Set 1 Table 5 entry (latest balance for 2025-2026 SEM 1)
        $set1Table5Entry = AccountSubledger::where('user_id', $note->user_id)
            ->where('school_year', '2025-2026')
            ->where('semester', '1')
            ->orderByDesc('date')
            ->first();

        Payment::create([
            'pn_id' => $note->pn_id,
            'amount' => $subledgerEntry->balance,
            'payment_date' => now(),
            'remarks' => 'Recorded from subledger entry 3, set 2',
        ]);

        $note->is_settled = true;
        $note->save();

        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            Notification::create([
                'user_id' => $admin->id,
                'pn_id' => $note->pn_id,
                'content' => 'Payment recorded for Promissory Note #' . $note->pn_id .
                    ' (' . $note->user->fullname . ') with amount ₱' . number_format($subledgerEntry->balance, 2) . '.',
                'is_read' => false,
                'sent_at' => now(),
            ]);
        }

        // Send email to user using Set 1 Table 5 balance
        $set1Balance = $set1Table5Entry ? $set1Table5Entry->balance : $subledgerEntry->balance;
        Mail::to($note->user->email)->send(new PaymentRecorded($note, $set1Balance));

        return redirect()->back()->with('success', 'Payment recorded successfully, SMS and email sent.');
    }

    public function paymentTrackingTablePartial()
    {
        $notes = PromissoryNote::with(['user', 'payments'])
            ->where('status', 'approved')
            ->get();

        return view('admin.partials.payment-tracking-table', compact('notes'));
    }
}
