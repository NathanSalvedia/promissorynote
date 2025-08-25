<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromissoryNote;


class ManageRecordsController extends Controller
{
    public function index()
    {
        $pendingNotes = PromissoryNote::where('status', 'pending')->get();
        return view('admin.manage-record', compact('pendingNotes'));
    }

    public function show($pn_id)
    {
        $note = PromissoryNote::findOrFail($pn_id);
        return view('admin.promissorynote-detail', compact('note'));
    }
}
