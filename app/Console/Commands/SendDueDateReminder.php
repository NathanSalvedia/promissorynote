<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PromissoryNote;
use App\Models\Notification;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\DueDateReminderMail;

// Add Vonage classes
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;

class SendDueDateReminder extends Command
{
    protected $signature = 'app:send-due-date-reminder';
    protected $description = 'Send due date reminders via email, notification, and SMS';

    public function handle()
    {
        $today = Carbon::today();
        $targetDate = $today->copy()->addDay();

        $notes = PromissoryNote::whereDate('due_date', $targetDate)
            ->where('is_settled', false)
            ->get();

        $admins = User::where('role', 'admin')->get();

        // Setup Vonage client
        $basic  = new Basic(env('VONAGE_KEY'), env('VONAGE_SECRET'));
        $client = new Client($basic);

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

            // Send SMS to student
            $user = $note->user;
            if ($user && $user->phone_number) {
                $smsMessage = "Good day! This is from St. Peter's College. Reminder: Your Promissory Note (PN-{$note->pn_id}) is due tomorrow ({$note->due_date}). Please settle your payment. Thank you!";
                try {
                    $sms = new SMS(
                        $user->phone_number,
                        env('VONAGE_FROM'),
                        $smsMessage
                    );
                    $client->sms()->send($sms);
                } catch (\Exception $e) {
                    \Log::error('Vonage SMS failed: ' . $e->getMessage());
                }
            }

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

