<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ManageUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.manage-user', compact('users'));
    }
}
