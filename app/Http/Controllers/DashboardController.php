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
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();

        // Fetch all promissory notes for the user, including resubmissions
        $notes = PromissoryNote::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        $notifications = Notification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $unreadCount = Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->count();

        return view('student.dashboard', compact('notes', 'notifications', 'unreadCount'));
    }

    public function markNotificationsRead(Request $request)
    {
        $userId = Auth::id();
        Notification::where('user_id', $userId)
            ->where('is_read', false)
            ->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }

    public function showNotifications()
    {
        $user = Auth::user();

        // Fetch regular notifications
        $notifications = Notification::where('user_id', $user->id)->get();

        // Check if user needs email verification
        if (is_null($user->email_verified_at)) {
            $verificationNotification = (object)[
                'content' => 'Please verify your email address to access all features.',
                'sent_at' => now(),
                'link' => route('verification.notice'),
            ];
            $notifications->push($verificationNotification);
        }

        return view('student.notification-view', compact('notifications'));
    }
}










