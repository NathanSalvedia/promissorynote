<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PromissoryNote;
use App\Models\Notification;
use App\Models\User;

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
        $notifications = Notification::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        $unreadCount = Notification::where('user_id', $user->id)->where('is_read', false)->count();

        return view('student.dashboard', compact('promissoryNotes', 'notifications', 'unreadCount'));
    }



    }










