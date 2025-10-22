<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PromissoryNote;
use App\Models\Notification;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\DueDateReminderMail;

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
        $today = Carbon::today();
        $targetDate = $today->copy()->addDay();

        $notes = PromissoryNote::whereDate('due_date', $targetDate)
            ->where('is_settled', false)
            ->get();

        $admins = User::where('role', 'admin')->get();

        foreach ($notes as $note) {
            // Notify the student
            Notification::create([
                'user_id' => $note->user_id,
                'pn_id' => $note->pn_id,
                'content' => "Reminder: Your promissory note is due tomorrow ({$note->due_date}).",
                'sent_at' => Carbon::now(),
                'is_read' => false,
            ]);
            // Send email to student
            Mail::to($note->user->email)->send(new DueDateReminderMail($note));

            // Notify each admin
            foreach ($admins as $admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'pn_id' => $note->pn_id,
                    'content' => "Reminder: Promissory note PN-{$note->pn_id} for {$note->user->name} is due tomorrow ({$note->due_date}).",
                    'sent_at' => Carbon::now(),
                    'is_read' => false,
                ]);
                // Send email to admin
                Mail::to($admin->email)->send(new DueDateReminderMail($note, true, $admin->name));
            }
        }
        $this->info('Due date reminders sent.');
    }
}

