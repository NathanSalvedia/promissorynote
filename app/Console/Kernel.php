<?php

namespace App\Console\Kernel;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // Run the due date reminder command daily at 8:00 AM
        $schedule->command('app:send-due-date-reminder')->dailyAt('08:00');
    }
}
