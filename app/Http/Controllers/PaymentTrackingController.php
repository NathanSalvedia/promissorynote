<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentTrackingController extends Controller
{
    public function index()
    {
        return view('admin.payment-tracking');
    }
}
