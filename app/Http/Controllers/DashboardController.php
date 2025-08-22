<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class DashboardController extends Controller
{

   // public function __construct()
    //{
       // $this->middleware(['auth']);
   // }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('student.dashboard');
    }
}
