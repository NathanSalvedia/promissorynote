<?php

namespace App\Console\Kernel;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\SendDueDateSmsReminders;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        SendDueDateSmsReminders::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Run the due date reminder command daily at 8:00 AM
        $schedule->command('sms:duedate-reminders')->dailyAt('08:00'); // Sends every day at 8AM
    }
}
