<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PromissoryNoteRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $note;

    /**
     * Create a new message instance.
     */
    public function __construct($note)
    {
        $this->note = $note;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Your Promissory Note Was Rejected')
            ->view('emails.promissory_note_rejected')
            ->with(['note' => $this->note]);
    }
}
