<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

        public function login(Request $request)
        {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $user = Auth::user();

                Log::info('Logged in user role: ' . var_export($user->role->value, true));
                if ($user->role->value === 'admin') {
                    return redirect()->route('admin.dashboard');
                } else {
                    Auth::logout();
                    return redirect()->back()->withErrors(['email' => 'Access denied. Role: ' . $user->role->value]);
                }
            }
            return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
        }

}
