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
    public $set1Table5Balance;

    public function __construct(PromissoryNote $note, $set1Table5Balance)
    {
        $this->note = $note;
        $this->set1Table5Balance = $set1Table5Balance;
    }

    public function build()
    {
        return $this->subject('Payment Recorded')
            ->view('emails.payment-recorded', [
                'note' => $this->note,
                'set1Table5Balance' => $this->set1Table5Balance
            ]);
    }
}
