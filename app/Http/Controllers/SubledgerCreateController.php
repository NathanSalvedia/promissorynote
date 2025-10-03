<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountSubledger;

class SubledgerCreateController extends Controller
{
    public function index()
    {
        // Show the subledger entry form
        return view('admin.subledger-create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'school_year' => 'required|string',
            'semester' => 'required|string',
            'date' => 'required|date',
            'reference' => 'required|string',
            'debit' => 'required|numeric',
            'credit' => 'required|numeric',
            'balance' => 'required|numeric',
        ]);

        // Create the subledger entry
        AccountSubledger::create($validated);

        // Redirect to the GET route (not the POST route) after saving
        return redirect()->route('admin.subledger-create')->with('success', 'Entry added!');
    }
}
