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

        $notifications = Notification::where('user_id', $adminId)
            ->orderBy('sent_at', 'desc')
            ->take(10)
            ->get();

        $unreadCount = Notification::where('user_id', $adminId)
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
        // Get the promissory note
        $note = PromissoryNote::findOrFail($pn_id);

        // Get subledger entry: set 2, entry 3
        $subledgerEntry = AccountSubledger::where('user_id', $note->user_id)
            ->where('school_year', $note->academic_year)
            ->where('semester', '2')
            ->orderBy('date')
            ->orderBy('subledger_id')
            ->skip(2) // entry number 3 (zero-based index)
            ->first();

        if (!$subledgerEntry) {
            return redirect()->back()->with('error', 'Subledger entry not found.');
        }

        // Store payment
        Payment::create([
            'pn_id' => $note->pn_id,
            'amount' => $subledgerEntry->balance,
            'payment_date' => now(),
            'remarks' => 'Recorded from subledger entry 3, set 2',
        ]);

        // Mark promissory note as settled
        $note->is_settled = true;
        $note->save();

        // Send push notification to admin
        $admin = User::where('role', 'admin')->first();
        if ($admin) {
            $admin->notify(new PaymentCompleted($note->user, $note));
        }

        // Send SMS notification to user
        $note->user->notify(new PaymentCompleted($note->user, $note));

        return redirect()->back()->with('success', 'Payment recorded successfully.');
    }
}
