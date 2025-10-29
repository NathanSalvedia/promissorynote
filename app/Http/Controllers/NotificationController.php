<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $notifications = Notification::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        // show student notifications (fixed)
        return view('student.notification-view', compact('notifications'));
    }

    public function view()
    {
        $userId = Auth::id();
        $notifications = Notification::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('student.notification-view', compact('notifications'));
    }

    public function adminIndex()
    {
        $adminId = Auth::id();
        $notifications = Notification::where('user_id', $adminId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.notification-view', compact('notifications'));
    }
}
