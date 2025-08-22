<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'fullname' => 'Admin user',
            'email' => 'admin@example.com',
            'course' => 'admin',
            'year_level' => 'N/A',
            'college' => 'N/A',
            'gender' => 'N/A',
            'submission_count' => 0,
        ]);
    }
}
