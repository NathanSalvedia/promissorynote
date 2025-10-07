<?php

namespace Database\Factories;

use App\Models\AccountSubledger;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountSubledgerFactory extends Factory
{
    protected $model = AccountSubledger::class;

    public function definition(): array
    {
        // Randomly decide if this is a debit or credit row
        $isDebit = $this->faker->boolean(40); // 40% chance debit, 60% credit

        // Reference: sometimes a number, sometimes 'Billing'
        $reference = $this->faker->boolean(30)
            ? 'Billing'
            : (string)$this->faker->numberBetween(80000, 90000);

        // School year and semester
        $schoolYear = '2025-2026';
        $semester = '1';

        // Date within the school year
        $date = $this->faker->dateTimeBetween('2025-08-01', '2025-12-31')->format('Y-m-d');

        // Debit/Credit logic
        $debit = $isDebit ? $this->faker->randomFloat(2, 10000, 25000) : 0.00;
        $credit = !$isDebit ? $this->faker->randomFloat(2, 500, 5000) : 0.00;

        // Fake balance (not a real running total, but plausible)
        $balance = $isDebit
            ? $debit
            : $this->faker->randomFloat(2, 10000, 25000) - $credit;

        return [
            'school_year' => $schoolYear,
            'semester' => $semester,
            'date' => $date,
            'reference' => $reference,
            'debit' => $debit,
            'credit' => $credit,
            'balance' => $balance,
        ];
    }
}
