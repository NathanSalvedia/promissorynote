<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromissoryNote;
use App\Models\User;
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
        $note = PromissoryNote::with('user')->where('pn_id', $pn_id)->firstOrFail();
        return view('admin.promissorynote-show', compact('note'));
    }

    public function archivedNotes()
    {
        $archivedNotes = PromissoryNote::where('archived', true)->get();

        foreach ($archivedNotes as $note) {
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

        return view('admin.manage-record', compact(
            'promissoryNotes',
            'departments',
            'totalNotes',
            'archivedNotesCount'
        ));
    }


}
