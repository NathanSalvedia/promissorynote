<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ManageUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $adminId = Auth::id();

        $notifications = Notification::where('user_id', $adminId)
            ->orderBy('sent_at', 'desc')
            ->take(10)
            ->get();

        $unreadCount = Notification::where('user_id', $adminId)
            ->where('is_read', false)
            ->count();

        return view('admin.manage-user', compact('users', 'notifications', 'unreadCount'));
    }

    public function userTablePartial()
    {
        $users = User::latest()->get();
        return view('admin.partials.user-table', compact('users'));
    }
}
