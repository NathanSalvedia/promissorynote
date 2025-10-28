<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PromissoryNote;
use App\Models\User;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;
use Carbon\Carbon;

class SendDueDateSmsReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-due-date-sms-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send SMS reminders to users a day before promissory note due date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->toDateString();

        $notes = PromissoryNote::where('due_date', $tomorrow)->get();

        $basic  = new Basic(env('VONAGE_KEY'), env('VONAGE_SECRET'));
        $client = new Client($basic);

        foreach ($notes as $note) {
            $user = $note->user;
            $to = $user->phone_number;
            $from = env('VONAGE_SMS_FROM', 'SPC');
            $message = "Good day! This is from St. Peters College. Reminder: Your promissory note (PN #{$note->pn_id}) is due tomorrow ({$note->due_date}). Please settle your payment.";

            try {
                $client->sms()->send(
                    new SMS($to, $from, $message)
                );
                $this->info("SMS sent to {$to} for PN #{$note->pn_id}");
            } catch (\Exception $e) {
                $this->error("Failed to send SMS to {$to}: " . $e->getMessage());
            }
        }
    }
}
