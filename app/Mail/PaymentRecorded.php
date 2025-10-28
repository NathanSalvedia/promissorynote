<?php

namespace App\Mail;

use App\Models\PromissoryNote;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentRecorded extends Mailable
{
    use Queueable, SerializesModels;

    public $note;
    public $amount;

    public function __construct(PromissoryNote $note, $amount)
    {
        $this->note = $note;
        $this->amount = $amount;
    }

    public function build()
    {
        $note = $this->note;
        $set1Table5Entry = $note->set1Table5Entry;

        return $this->subject('Payment Recorded')
            ->view('emails.payment-recorded', [
                'note' => $note,
                'set1Table5Balance' => $set1Table5Entry->balance
            ]);
    }
}
