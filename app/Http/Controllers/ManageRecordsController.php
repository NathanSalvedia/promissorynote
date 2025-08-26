<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromissoryNote;
use App\Models\User;

class ManageRecordsController extends Controller
{
    public function index()
    {
        $promissoryNotes = PromissoryNote::with('user')->orderBy('created_at', 'desc')->get();
        $totalNotes = $promissoryNotes->count();
        $pendingNotes = $promissoryNotes->where('status', 'pending')->count();
        $approvedNotes = $promissoryNotes->where('status', 'approved')->count();
        $rejectedNotes = $promissoryNotes->where('status', 'rejected')->count();
        return view('admin.manage-record', compact('promissoryNotes', 'totalNotes', 'pendingNotes', 'approvedNotes', 'rejectedNotes'));
    }


    public function manageRecords()
    {
        $promissoryNotes = PromissoryNote::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.manage-record', compact('promissoryNotes'));
    }
}
