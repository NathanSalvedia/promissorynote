<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubledgerController extends Controller
{
    public function index()
    {
        return view('student.subledger');
    }
}
