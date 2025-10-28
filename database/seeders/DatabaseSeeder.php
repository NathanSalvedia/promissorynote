<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\AccountSubledger;
use App\Models\Downpayment;
use App\Models\PromissoryNote;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Enums\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\Notification;

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
            'phone_number' => 'N/A',
            'password' => Hash::make('adminpassword'),
            'role' => Role::ADMIN->value,
            'course' => 'N/A',
            'student_id' => 0,
            'year_level' => 'N/A',
            'college' => 'N/A',
            'gender' => 'N/A',
            'submission_count' => 0,
        ]);
            */




       User::all()->each(function ($user) use ($faker) {

     //AccountSubledger::where('user_id', $user->id)->delete();
              /*
        // Generate initial 4 Set 1 entries if not already present
        $set1Count = AccountSubledger::where('user_id', $user->id)
            ->where('school_year', '2025-2026')
            ->where('semester', '1')
            ->count();

        if ($set1Count < 4) {
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
                    : (string)$faker->numberBetween(10000, 90000);

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
        }
              */


        //======================================================//

         /*
        $promissoryNote = PromissoryNote::where('user_id', $user->id)->first();

        if ($promissoryNote) {
            // Get the last subledger entry BEFORE promissory note payment or Set 2
            $originalEntry = AccountSubledger::where('user_id', $user->id)
                ->where('school_year', $promissoryNote->academic_year)
                ->where('semester', $promissoryNote->semester == '1st Semester' ? '1' : '2')
                ->orderByDesc('date')
                ->first();

            $assessmentBalance = $originalEntry ? (float)str_replace(',', '', $originalEntry->balance) : 0;

            $promissoryNote->assessment_balance = $assessmentBalance;
            $promissoryNote->save();

            $entryDate = $faker->dateTimeBetween('2026-01-12', '2026-12-31')->format('Y-m-d');
            $pnCredit = (float)$promissoryNote->amount;
            $fifthEntryBalance = max(0, $assessmentBalance - $pnCredit);

            $nextYearStart = intval(substr($promissoryNote->academic_year, 0, 4)) + 1;
            $nextYearEnd = intval(substr($promissoryNote->academic_year, 5, 4)) + 1;
            $nextYear = $nextYearStart . '-' . $nextYearEnd;

            // Check if both Billing and Downpayment entries exist for Set 2
            $billingExists = AccountSubledger::where('user_id', $user->id)
                ->where('school_year', $nextYear)
                ->where('semester', '2')
                ->where('reference', 'Billing')
                ->exists();

            $downpaymentExists = AccountSubledger::where('user_id', $user->id)
                ->where('school_year', $nextYear)
                ->where('semester', '2')
                ->where('credit', '600.00')
                ->exists();

            // Only create Set 2 entries if neither exists
            if (!$billingExists && !$downpaymentExists) {
                // 5th Set 1 entry (promissory note payment)
                AccountSubledger::create([
                    'user_id' => $user->id,
                    'school_year' => $promissoryNote->academic_year,
                    'semester' => $promissoryNote->semester == '1st Semester' ? '1' : '2',
                    'date' => $entryDate,
                    'reference' => (string)$faker->numberBetween(80000, 90000),
                    'debit' => '0.00',
                    'credit' => number_format($pnCredit, 2, '.', ''),
                    'balance' => number_format($fifthEntryBalance, 2, '.', ''),
                ]);

                $billingAmount = $faker->randomFloat(2, 25000, 32000);
                $set2Balance = $billingAmount + $fifthEntryBalance;

                AccountSubledger::create([
                    'user_id' => $user->id,
                    'school_year' => $nextYear,
                    'semester' => '2',
                    'date' => $entryDate,
                    'reference' => 'Billing',
                    'debit' => number_format($billingAmount, 2, '.', ''),
                    'credit' => '0.00',
                    'balance' => number_format($set2Balance, 2, '.', ''),
                ]);

                // Downpayment for Set 2
                $downpaymentCredit = 600;
                $downpaymentBalance = max(0, $set2Balance - $downpaymentCredit);

                AccountSubledger::create([
                    'user_id' => $user->id,
                    'school_year' => $nextYear,
                    'semester' => '2',
                    'date' => $entryDate,
                    'reference' => (string)$faker->numberBetween(80000, 90000),
                    'debit' => '0.00',
                    'credit' => number_format($downpaymentCredit, 2, '.', ''),
                    'balance' => number_format($downpaymentBalance, 2, '.', ''),
                ]);
            }
        }
            */

   //======================================================//

   $set1Table5Entry = AccountSubledger::where('user_id', $user->id)
       ->where('school_year', '2025-2026')
       ->where('semester', '1')
       ->orderByDesc('date')
       ->first();


   $nextYearStart = 2026;
   $nextYearEnd = 2027;
   $nextYear = $nextYearStart . '-' . $nextYearEnd;


   $table2Set2DownpaymentEntry = AccountSubledger::where('user_id', $user->id)
       ->where('school_year', $nextYear)
       ->where('semester', '2')
       ->orderBy('date', 'asc')
       ->skip(1)
       ->first();


   $set2Entry3Exists = AccountSubledger::where('user_id', $user->id)
       ->where('school_year', $nextYear)
       ->where('semester', '2')
       ->orderBy('date', 'asc')
       ->skip(2)
       ->first();

   $subledgerEntry = null;

   if ($set1Table5Entry && $table2Set2DownpaymentEntry && !$set2Entry3Exists) {

       $set1Balance = (float)str_replace(',', '', $set1Table5Entry->balance);
       $table2Set2DownpaymentBalance = (float)str_replace(',', '', $table2Set2DownpaymentEntry->balance);


       $resultBalance = $table2Set2DownpaymentBalance - $set1Balance;

       $entryDate = $faker->dateTimeBetween('2026-05-12', '2026-12-31')->format('Y-m-d');
       $reference = (string)$faker->numberBetween(10000, 99999);

       // Extra check for duplicate entry for this user
       $alreadyExists = AccountSubledger::where('user_id', $user->id)
           ->where('school_year', $nextYear)
           ->where('semester', '2')
           ->where('reference', $reference)
           ->exists();


       if (!$alreadyExists) {
           $subledgerEntry = AccountSubledger::create([
               'user_id' => $user->id,
               'school_year' => $nextYear,
               'semester' => '2',
               'date' => $entryDate,
               'reference' => $reference,
               'debit' => '0.00',
               'credit' => number_format($set1Balance, 2, '.', ''),
               'balance' => number_format($resultBalance, 2, '.', ''),
           ]);
       }
   }

   // Only send notification if payment entry was created
   if ($subledgerEntry) {
       $admin = User::where('role', 'admin')->first();
       $promissoryNote = PromissoryNote::where('user_id', $user->id)
           ->orderByDesc('due_date')
           ->first();

       if ($admin && $promissoryNote) {
           Notification::create([
               'user_id' => $admin->id,
               'pn_id' => $promissoryNote->pn_id,
               'content' => 'Payment Received for Promissory Note #' . $promissoryNote->pn_id .
                   ' (' . $user->fullname . ') with amount ₱' . number_format($set1Table5Entry->balance, 2) . '.',
               'is_read' => false,
               'sent_at' => now(),
           ]);
       }
}


      });

    }
}
