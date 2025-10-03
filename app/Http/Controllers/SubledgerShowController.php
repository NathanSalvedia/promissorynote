<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\AccountSubledger;

class SubledgerShowController extends Controller
{
    public function index($student_id)
    {
        $user = User::where('student_id', $student_id)->firstOrFail();
        $entries = AccountSubledger::where('user_id', $user->id)
            ->orderBy('school_year')
            ->orderBy('semester')
            ->orderBy('date')
            ->get();


    return view('admin.subledger-show', compact('user', 'entries'));
    }
}
