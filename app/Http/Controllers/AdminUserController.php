<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        // code for index method
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user-details', compact('user'));
    }
}
