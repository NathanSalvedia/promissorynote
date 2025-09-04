<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountSubledger;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SubledgerController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $entries = AccountSubledger::where('user_id', $userId)
            ->orderBy('school_year')
            ->orderBy('semester')
            ->orderBy('date')
            ->get();

        $tuitionBalance = AccountSubledger::where('user_id', $userId)
            ->orderByDesc('date')
            ->orderByDesc('subledger_id')
            ->value('balance');

        return view('student.subledger', compact('entries', 'tuitionBalance'));
    }

    public function UserBalance($userId)
    {
        $latestBalance = AccountSubledger::where('user_id', $userId)
            ->orderByDesc('date')
            ->orderByDesc('subledger_id')
            ->value('balance');

        User::where('id', $userId)->update(['balance' => $latestBalance]);
    }
}
