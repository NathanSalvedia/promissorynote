<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DueDateReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $note;
    public $isAdmin;
    public $adminName;

    public function __construct($note, $isAdmin = false, $adminName = null)
    {
        $this->note = $note;
        $this->isAdmin = $isAdmin;
        $this->adminName = $adminName;
    }

    public function build()
    {
        $subject = $this->isAdmin
            ? "Reminder: Promissory Note PN-{$this->note->pn_id} Due Tomorrow"
            : "Reminder: Your Promissory Note is Due Tomorrow";

        return $this->subject($subject)
            ->view('emails.due_date_reminder');
    }
}
