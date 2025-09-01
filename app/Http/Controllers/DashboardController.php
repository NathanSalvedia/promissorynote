<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PromissoryNote;
use App\Models\Approve;

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
    $user = Auth::user();
    $promissoryNotes = PromissoryNote::where('user_id', $user->id)->get();
    return view('student.dashboard', compact('promissoryNotes'));
    }
}
