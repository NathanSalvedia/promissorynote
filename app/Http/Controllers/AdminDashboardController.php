<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromissoryNote;
use App\Models\Evaluation;
use Carbon\Carbon;
use App\Models\Approve;
use App\Models\Notification;
use App\Models\User;
use App\Models\AccountSubledger;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailable;
use App\Mail\PromissoryNoteApproved;

class AdminDashboardController extends Controller
{
    /**
     * Display the dashboard with stats and filtering.
     */
    public function index(Request $request)
    {
        $departments = PromissoryNote::select('department')->distinct()->pluck('department');

        $query = PromissoryNote::with('user');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('user', function($q) use ($search) {
                $q->where('course', 'like', "%$search%");
            });
        }

        if ($request->filled('department')) {
            $query->where('department', $request->input('department'));
        }

        $notes = $query->get();


        $notes = $notes->sortBy(function($note) {
            return $note->pn_id;
        })->values();

        foreach ($notes as $note) {
            $note->is_new = false;
            if (
                Carbon::parse($note->created_at)->diffInMinutes(now()) < 3
            ) {
                $note->is_new = true;
            }
        }

        $totalNotes = $notes->count();
        $pendingNotes = $notes->where('status', 'pending')->count();
        $approvedNotes = $notes->where('status', 'approved')->count();
        $rejectedNotes = $notes->where('status', 'rejected')->count();



        $adminId = Auth::id();

        $notifications = Notification::where('user_id', $adminId)
            ->orderBy('sent_at', 'desc')
            ->take(10)
            ->get();

        $unreadCount = Notification::where('user_id', $adminId)
            ->where('is_read', false)
            ->count();

        return view('admin.admindashboard', compact(
            'notes',
            'totalNotes',
            'pendingNotes',
            'approvedNotes',
            'rejectedNotes',
            'departments',
            'notifications',
            'unreadCount'
        ));
    }

    /**
     * Show specific promissory note.
     */
    public function show($pn_id)
    {
        $note = PromissoryNote::with('supportingDocuments', 'user')->where('pn_id', $pn_id)->firstOrFail();


        $set1Entries = AccountSubledger::where('user_id', $note->user_id)
            ->where('school_year', $note->academic_year)
            ->where('semester', '1')
            ->orderBy('date')
            ->orderBy('subledger_id')
            ->get();


        $assessmentBalance = isset($set1Entries[3]) ? (float)str_replace(',', '', $set1Entries[3]->balance) : 0;
        $partialPayment = $note->amount ?? 0;
        $remainingBalance = max(0, $assessmentBalance - $partialPayment);

        return view('admin.promissorynote-detail', [
            'note' => $note,
            'assessmentBalance' => $assessmentBalance,
            'partialPayment' => $partialPayment,
            'remainingBalance' => $remainingBalance
        ]);
    }

    /**
     * Approve a promissory note → also mark as settled.
     */
    public function approve($pn_id)
    {
        $note = PromissoryNote::findOrFail($pn_id);
        $note->status = 'approved';
        $note->save();

        // Create in-app notification for the user
        Notification::create([
            'user_id' => $note->user_id,
            'pn_id'   => $note->pn_id,
            'content' => 'Your promissory note has been approved.',
            'sent_at' => now(),
            'is_read' => false,
        ]);

        // Send email notification
        if ($note->user && $note->user->email) {
            Mail::to($note->user->email)->send(new PromissoryNoteApproved($note));
        }

        return redirect()->route('admin.dashboard')->with('success', 'Promissory Note approved.');
    }

    /**
     * Reject a promissory note → keep as unsettled.
     */
    public function reject($pn_id)
    {
        $note = PromissoryNote::findOrFail($pn_id);
        $note->status = 'rejected';
        $note->save();

        Notification::create([
            'user_id' => $note->user_id,
            'pn_id' => $note->pn_id,
            'content' => "Your promissory note #{$note->pn_id} has been rejected.",
            'sent_at' => now(),
            'is_read' => false,
        ]);

        return redirect()->back()->with('success', 'Promissorynote rejected successfully.');
    }

    /**
     * Display the subledger for a specific student.
     */
    public function StudentSubledger($student_id)
    {
        $user = User::where('student_id', $student_id)->firstOrFail();
        $entries = AccountSubledger::where('user_id', $user->id)
            ->orderBy('school_year')
            ->orderBy('semester')
            ->orderBy('date')
            ->get();

        return view('admin.student-subledger', compact('user', 'entries'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,pending'
        ]);
        $note = PromissoryNote::findOrFail($id);
        $note->status = $request->status;
        $note->save();

        Notification::create([
            'user_id' => $note->user_id,
            'pn_id' => $note->pn_id,
            'content' => "Your promissory note #{$note->pn_id} has been {$note->status}.",
            'sent_at' => now(),
            'is_read' => false,
        ]);

        return redirect()->back()->with('success', 'Status updated and notification sent.');
    }


    public function downloadArchivedNote($pn_id)
  {
    $note = PromissoryNote::with('user')->findOrFail($pn_id);
    $pdf = Pdf::loadView('admin.pdf.archived-note', compact('note'));
    return $pdf->download('PN-'.$note->pn_id.'.pdf');
  }

  public function deny(Request $request, $pn_id)
{
    $request->validate([
        'denial_reason' => 'required|string|max:1000',
    ]);

    $note = PromissoryNote::findOrFail($pn_id);
    $note->status = 'rejected';
    $note->denial_reason = $request->denial_reason;
    $note->denied_by = Auth::id();
    $note->denied_at = now();
    $note->save();

    Notification::create([
        'user_id' => $note->user_id,
        'pn_id'   => $note->pn_id,
        'content' => "Your promissory note #{$note->pn_id} was rejected. Reason: {$request->denial_reason}",
        'sent_at' => now(),
        'is_read' => false,
    ]);

    return redirect()->route('admin.promissorynote-detail', $note->pn_id)
        ->with('success', 'Request denied and notification sent.');
}
}
