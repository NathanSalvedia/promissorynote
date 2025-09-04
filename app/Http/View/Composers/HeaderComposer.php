<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class HeaderComposer
{
    public function compose(View $view)
    {
        $notifications = [];
        $unreadCount = 0;

        if (Auth::check()) {
            $user = Auth::user();
            $notifications = Notification::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
            $unreadCount = Notification::where('user_id', $user->id)->where('is_read', false)->count();
        }

        $view->with('notifications', $notifications)
             ->with('unreadCount', $unreadCount);
    }
}
