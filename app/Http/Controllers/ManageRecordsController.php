<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromissoryNote;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\AccountSubledger;
use Carbon\Carbon;

class ManageRecordsController extends Controller
{
    public function index(Request $request)
    {
        $promissoryNotes = PromissoryNote::where('archived', false)->get();
        $archivedNotesCount = PromissoryNote::where('archived', true)->count();

        foreach ($promissoryNotes as $note) {
            $due = $note->due_date ?? null;
            $today = Carbon::today();

            $note->is_settled = isset($note->is_settled) ? $note->is_settled : false;
            if ($note->is_settled) {
                $note->remarks = 'Settled';
            } else if ($due) {
                $dueCarbon = Carbon::parse($due);
                if ($dueCarbon->isSameDay($today)) {
                    $note->remarks = 'Not settled';
                } elseif ($dueCarbon->isFuture()) {
                    $note->remarks = 'Not overdue yet';
                } else {
                    $note->remarks = 'Overdue';
                }
                $note->due_date_formatted = $dueCarbon->format('Y-m-d');
            } else {
                $note->remarks = 'No due date';
                $note->due_date_formatted = '';
            }
        }

        return view('admin.manage-record', compact('promissoryNotes', 'archivedNotesCount'));
    }

    public function manageRecords()
    {
        $promissoryNotes = PromissoryNote::with('user')->orderBy('created_at', 'desc')->get();
        $notifications = [];
        $totalNotes = $promissoryNotes->count();

        foreach ($promissoryNotes as $note) {
            $due = $note->due_date ?? null;
            $today = Carbon::today();

            $note->is_settled = isset($note->is_settled) ? $note->is_settled : false;
            if ($note->is_settled) {
                $note->remarks = 'Settled';
            } else if ($due) {
                $dueCarbon = Carbon::parse($due);
                if ($dueCarbon->isSameDay($today)) {
                    $note->remarks = 'Not settled';
                } elseif ($dueCarbon->isFuture()) {
                    $note->remarks = 'Not overdue yet';
                } else {
                    $note->remarks = 'Overdue';
                }
                $note->due_date_formatted = $dueCarbon->format('Y-m-d');
            } else {
                $note->remarks = 'No due date';
                $note->due_date_formatted = '';
            }
        }

        return view('admin.manage-record', compact('promissoryNotes', 'notifications', 'totalNotes'));
    }

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

        return view('admin.promissorynote-show', [
            'note' => $note,
            'assessmentBalance' => $assessmentBalance,
            'partialPayment' => $partialPayment,
            'remainingBalance' => $remainingBalance
        ]);
    }

    public function archivedNotes()
    {
        $archivedNotes = PromissoryNote::with('supportingDocuments', 'user')
            ->where('archived', true)
            ->get();

        foreach ($archivedNotes as $note) {

            $assessmentBalance = AccountSubledger::where('user_id', $note->user_id)
                ->where('school_year', $note->academic_year)
                ->where('semester', $note->semester == '1st Semester' ? '1' : '2')
                ->where('reference', 'Billing')
                ->orderByDesc('date')
                ->orderByDesc('subledger_id')
                ->value('debit');

            $note->assessmentBalance = $assessmentBalance ? (float)str_replace(',', '', $assessmentBalance) : 0;
            $note->partialPayment = $note->amount ?? 0;
            $note->remainingBalance = max(0, $note->assessmentBalance - $note->partialPayment);

            $due = $note->due_date ?? null;
            $today = Carbon::today();

            $note->is_settled = isset($note->is_settled) ? $note->is_settled : false;
            if ($note->is_settled) {
                $note->remarks = 'Settled';
            } else if ($due) {
                $dueCarbon = Carbon::parse($due);
                if ($dueCarbon->isSameDay($today)) {
                    $note->remarks = 'Not settled';
                } elseif ($dueCarbon->isFuture()) {
                    $note->remarks = 'Not overdue yet';
                } else {
                    $note->remarks = 'Overdue';
                }
                $note->due_date_formatted = $dueCarbon->format('Y-m-d');
            } else {
                $note->remarks = 'No due date';
                $note->due_date_formatted = '';
            }
        }

        return view('admin.archived-notes', compact('archivedNotes'));
    }

    public function archive($pn_id)
    {
        $note = PromissoryNote::findOrFail($pn_id);
        $note->archived = true;
        $note->save();

        return redirect()->route('admin.manage-record')->with('success', 'Record archived successfully.');
    }

    public function restore($pn_id)
    {
        $note = PromissoryNote::findOrFail($pn_id);
        $note->archived = false;
        $note->save();

        return redirect()->route('admin.archived-notes')->with('success', 'Record restored successfully.');
    }

    public function manageRecord(Request $request)
    {
        $query = PromissoryNote::with('user')->where('archived', false);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('course', 'like', "%{$search}%");
        }

        if ($request->filled('department')) {
            $department = $request->input('department');
            $query->where('department', $department);
        }

        if ($request->filled('status_sort')) {
            $status = $request->input('status_sort');
            $query->where('status', $status);
        }

        $promissoryNotes = $query->orderBy('created_at', 'desc')->get();

        $promissoryNotes = $promissoryNotes->sortBy(function($note) {
            return $note->pn_id;
        })->values();

        foreach ($promissoryNotes as $note) {
            $note->is_new = false;
            if (Carbon::parse($note->created_at)->diffInMinutes(now()) < 3) {
                $note->is_new = true;
            }
        }

        foreach ($promissoryNotes as $note) {
            $due = $note->due_date ?? null;
            $today = Carbon::today();

            $note->is_settled = isset($note->is_settled) ? $note->is_settled : false;
            if ($note->is_settled) {
                $note->remarks = 'Settled';
            } else if ($due) {
                $dueCarbon = Carbon::parse($due);
                if ($dueCarbon->isSameDay($today)) {
                    $note->remarks = 'Not settled';
                } elseif ($dueCarbon->isFuture()) {
                    $note->remarks = 'Not overdue yet';
                } else {
                    $note->remarks = 'Overdue';
                }
                $note->due_date_formatted = $dueCarbon->format('Y-m-d');
            } else {
                $note->remarks = 'No due date';
                $note->due_date_formatted = '';
            }
        }

        $departments = PromissoryNote::whereNotNull('department')->distinct()->pluck('department');
        $totalNotes = $promissoryNotes->count();
        $archivedNotesCount = PromissoryNote::where('archived', true)->count();

         $adminId = Auth::id();
         $notifications = Notification::where('user_id', $adminId)
            ->orderBy('sent_at', 'desc')
            ->take(10)
            ->get();

             $unreadCount = Notification::where('user_id', $adminId)
            ->where('is_read', false)
            ->count();

        $resubmissions = PromissoryNote::with('user')
            ->where('archived', false)
            ->whereNotNull('parent_pn_id')
            ->orderBy('created_at', 'desc')
            ->get();
        $resubmissionCount = $resubmissions->count();

        return view('admin.manage-record', compact(
            'promissoryNotes',
            'departments',
            'totalNotes',
            'archivedNotesCount',
            'resubmissions',
            'notifications',
            'unreadCount',
            'resubmissionCount'
        ));
    }

    public function recordsTablePartial(Request $request)
    {
        $promissoryNotes = PromissoryNote::with('user')->where('archived', false)->latest()->get();

        foreach ($promissoryNotes as $note) {
            $due = $note->due_date ?? null;
            $today = Carbon::today();

            $note->is_settled = isset($note->is_settled) ? $note->is_settled : false;
            if ($note->is_settled) {
                $note->remarks = 'Settled';
            } else if ($due) {
                $dueCarbon =Carbon::parse($due);
                if ($dueCarbon->isSameDay($today)) {
                    $note->remarks = 'Not settled';
                } elseif ($dueCarbon->isFuture()) {
                    $note->remarks = 'Not overdue yet';
                } else {
                    $note->remarks = 'Overdue';
                }
                $note->due_date_formatted = $dueCarbon->format('Y-m-d');
            } else {
                $note->remarks = 'No due date';
                $note->due_date_formatted = '';
            }
        }

        return view('admin.partials.records-table', compact('promissoryNotes'));
    }


}
