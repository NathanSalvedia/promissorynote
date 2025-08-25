<?php

namespace App\Enums;

enum Role: string
{
    case ADMIN = 'admin';

    case STUDENT = 'student';


    // use App\Enums\Role;
    // $user->role = Role::ADMIN;
    // if ($user->role === Role::ADMIN) { /* user is admin */ }
    // $roleString = $user->role->value; // 'admin'
    // if ($user->role->value === 'admin') { /* user is admin */ }
}
