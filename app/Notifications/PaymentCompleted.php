<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use Illuminate\Notifications\Messages\VonageMessage; // <-- Use VonageMessage

class PaymentCompleted extends Notification
{
    use Queueable;

    public $user;
    public $note;

    /**
     * Create a new notification instance.
     */
    public function __construct($user, $note)
    {
        $this->user = $user;
        $this->note = $note;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['webpush', 'vonage']; // <-- Use 'vonage' instead of 'nexmo'
    }

    /**
     * Get the web push representation of the notification.
     */
    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('Payment Settled')
            ->body("{$this->user->fullname} has paid their last balance for SY {$this->note->academic_year}.")
            ->icon('https://api.iconify.design/mdi:cash.png?color=%2300b894');
    }

    public function toVonage($notifiable)
    {
        return (new VonageMessage)
            ->content("Good day! This is from St.Peter's College, your payment for your promissory note (SY {$this->note->academic_year}) has been recorded. Thank you!");
    }
}
