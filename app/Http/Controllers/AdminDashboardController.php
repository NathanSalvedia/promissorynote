<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromissoryNote;

class AdminDashboardController extends Controller
{
    /**
     * Display the dashboard with stats.
     */
    public function index()
    {
        $notes = PromissoryNote::with('user')->orderBy('created_at', 'desc')->get();
    $totalNotes = $notes->count();
    $pendingNotes = $notes->where('status', 'pending')->count();
    $approvedNotes = $notes->where('status', 'approved')->count();
    $rejectedNotes = $notes->where('status', 'rejected')->count();
    return view('admin.admindashboard', compact('notes', 'totalNotes', 'pendingNotes', 'approvedNotes', 'rejectedNotes'));
    }

    /**
     * Show specific promissory note.
     */
    public function show(string $id)
    {
        $note = PromissoryNote::findOrFail($id);
        return view('admin.promissorynote-detail', compact('note'));
    }

    /**
     * Approve a promissory note → also mark as settled.
     */
    public function approve($pn_id)
    {

        $note = PromissoryNote::findOrFail($pn_id);
        $note->status = 'approved';
        $note->save();
        return redirect()->back()->with('success', 'Promissory note approved successfully.');
    }

    /**
     * Reject a promissory note → keep as unsettled.
     */
    public function reject($pn_id)
    {
        $note = PromissoryNote::findOrFail($pn_id);
        $note->status = 'rejected';
        $note->save();
        return redirect()->back()->with('success', 'Promissory note rejected successfully.');
    }


    }
