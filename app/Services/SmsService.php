<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SmsService
{
    /**
     * Send SMS via BulkSMSBD API.
     *
     * @param string $message
     * @param string $number
     * @return bool
     */
    public static function send($message, $number)
    {
        $response = Http::withOptions(['verify' => false])->post(
            config('services.bulksms.api_url'),
            [
                'api_key'  => config('services.bulksms.api_key'),
                'senderid' => config('services.bulksms.sender_id'),
                'number'   => $number,
                'message'  => $message,
            ]
        );

        return $response->successful();
    }
}
