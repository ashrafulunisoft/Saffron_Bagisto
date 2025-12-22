<?php

namespace Webkul\Admin\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
    /**
     * Send SMS using the configured SMS API.
     *
     * @param string $phoneNumber
     * @param string $message
     * @return array
     */
    public function sendSms($phoneNumber, $message)
    {
        try {
            $apiKey = env('SMS_API_KEY', 'KsNp0AcYqTNzTxCpoVA6');
            $senderId = env('SMS_SENDER_ID', '8809617611744');
            $url = env('SMS_URL', 'https://bulksmsbd.net/api/smsapi');

            $fullUrl = $url . '?api_key=' . $apiKey . '&type=text&number=' . $phoneNumber . '&senderid=' . $senderId . '&message=' . urlencode($message);

            $response = Http::get($fullUrl);

            if ($response->successful()) {
                $responseData = json_decode($response->body(), true);

                Log::info('SMS sent successfully', [
                    'phone_number' => $phoneNumber,
                    'message' => $message,
                    'response' => $responseData
                ]);

                return [
                    'success' => true,
                    'message' => 'SMS sent successfully',
                    'response' => $responseData
                ];
            } else {
                Log::error('Failed to send SMS', [
                    'phone_number' => $phoneNumber,
                    'message' => $message,
                    'status' => $response->status(),
                    'response' => $response->body()
                ]);

                return [
                    'success' => false,
                    'message' => 'Failed to send SMS',
                    'response' => $response->body()
                ];
            }
        } catch (\Exception $e) {
            Log::error('SMS sending error', [
                'phone_number' => $phoneNumber,
                'message' => $message,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'message' => 'SMS sending error: ' . $e->getMessage(),
                'error' => $e->getMessage()
            ];
        }
    }
}
