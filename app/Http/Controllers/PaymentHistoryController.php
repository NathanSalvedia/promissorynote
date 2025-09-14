<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountSubledger;
use Illuminate\Support\Facades\Auth;

class PaymentHistoryController extends Controller
{
    public function index()
    {
        $subledgerEntries = AccountSubledger::where('user_id', Auth::user()->id)->orderBy('date')->get();
        return view('student.payment-history', compact('subledgerEntries'));
    }

    public function paymentHistory()
    {
        $subledgerEntries = AccountSubledger::where('user_id', Auth::user()->id)->orderBy('date')->get();
        return view('student.payment-history', compact('subledgerEntries'));
    }
}
