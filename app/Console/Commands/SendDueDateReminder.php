<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PromissoryNote;
use App\Models\Notification;
use Carbon\Carbon;

class SendDueDateReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-due-date-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reminderDays = [1];
        $today = Carbon::today();

        foreach ($reminderDays as $daysBefore) {
            $targetDate = $today->copy()->addDays($daysBefore);

            $notes = PromissoryNote::whereDate('due_date', $targetDate)
                ->where('is_settled', false)
                ->get();

            foreach ($notes as $note) {
                Notification::create([
                    'user_id' => $note->user_id,
                    'pn_id' => $note->pn_id,
                    'content' => "Reminder: Your promissory note is due on {$note->due_date}.",
                    'sent_at' => Carbon::now(),
                    'is_read' => false,
                ]);
            }
        }
        $this->info('Due date reminders sent.');
    }
}

