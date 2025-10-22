<?php

namespace App\Services;

use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS as VonageSMS;
use Illuminate\Support\Facades\Log;
class SmsService
{
    protected $client;
    protected $from;

    public function __construct()
    {
        $basic  = new Basic(config('services.vonage.key'), config('services.vonage.secret'));
        $this->client = new Client($basic);
        $this->from = config('services.vonage.sms_from');
    }

    public function send($to, $message)
    {
        try {
            $sms = new VonageSMS((string) $to, (string) $this->from, $message);
            return $this->client->sms()->send($sms);
        } catch (\Exception $e) {
            Log::error('Vonage SMS send failed: ' . $e->getMessage());
            return false;
        }
    }
}
