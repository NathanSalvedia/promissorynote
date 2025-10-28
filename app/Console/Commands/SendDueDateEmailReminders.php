<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PromissoryNote;
use Illuminate\Support\Facades\Mail;
use App\Mail\DueDateReminder; // <-- your mailable
use Carbon\Carbon;

class SendDueDateEmailReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-due-date-email-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email reminders to users a day before promissory note due date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->toDateString();
        $notes = PromissoryNote::where('due_date', $tomorrow)->get();

        foreach ($notes as $note) {
            $user = $note->user;
            Mail::to($user->email)->send(new DueDateReminder($note));
            $this->info("Email sent to {$user->email} for PN #{$note->pn_id}");
        }
    }
}
