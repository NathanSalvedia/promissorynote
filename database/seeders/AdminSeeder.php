<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illumminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'adminuser@example.com'],
            [
                'fullname' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'course' => 'N/A',
                'student_id' => 0,
                'year_level' => 'N/A',
                'college' => 'N/A',
                'gender' => 'N/A',
                'submission_count' => 0,
            ]
        );
    }
}
