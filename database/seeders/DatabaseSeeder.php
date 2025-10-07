<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\AccountSubledger;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Create admin user if not exists
        /*
        User::factory()->create([
            'fullname' => 'Admin user',
            'email' => 'adminuser@example.com',
            'course' => 'N/A',
            'student_id' => 0,
            'year_level' => 'N/A',
            'college' => 'N/A',
            'gender' => 'N/A',
            'submission_count' => 0,
        ]);
        */



        User::all()->each(function ($user) use ($faker) {

             AccountSubledger::where('user_id', $user->id)->delete();

                $entries = [];
                $dates = [];
                for ($i = 0; $i < 4; $i++) {
                    $dates[] = $faker->dateTimeBetween('2025-08-01', '2025-12-31');
                }
                sort($dates);

                $downpayment = $faker->randomFloat(2, 600, 1000);
                $billing = $faker->randomFloat(2, 25000, 32000);

                for ($i = 0; $i < 4; $i++) {
                    if ($i == 0) {
                        $debit = 0.00;
                        $credit = $downpayment;
                        $balance = $billing - $downpayment;
                    } elseif ($i == 1) {
                        $debit = $billing;
                        $credit = 0.00;
                        $balance = $billing;
                    } else {
                        $debit = 0.00;
                        $credit = $faker->randomFloat(2, 5000, 10000);
                        $balance = max(0, $entries[$i - 1]['balance'] - $credit);
                    }

                    $reference = $i == 1
                        ? 'Billing'
                        : (string)$faker->numberBetween(80000, 90000);

                    $entries[] = [
                        'user_id' => $user->id,
                        'school_year' => '2025-2026',
                        'semester' => '1',
                        'date' => $dates[$i]->format('Y-m-d'),
                        'reference' => $reference,
                        'debit' => number_format((float)$debit, 2, '.', ''),
                        'credit' => number_format((float)$credit, 2, '.', ''),
                        'balance' => number_format((float)$balance, 2, '.', ''),
                    ];
                }

                AccountSubledger::insert($entries);
        });

    }
}
