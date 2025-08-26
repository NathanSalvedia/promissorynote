<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromissoryNote;



class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $note = PromissoryNote::findOrFail($id);
        return view('admin.promissorynote-detail', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Approve a promissory note.
     */
    public function approve($pn_id)
    {
        $note = PromissoryNote::findOrFail($pn_id);
        $note->status = 'approved';
        $note->save();
        return redirect()->back()->with('success', 'Promissory note approved successfully.');
    }

    /**
     * Reject a promissory note.
     */
    public function reject($pn_id)
    {
        $note = PromissoryNote::findOrFail($pn_id);
        $note->status = 'rejected';
        $note->save();
        return redirect()->back()->with('success', 'Promissory note rejected successfully.');
    }

}
