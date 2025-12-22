<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Mail;


Route::get('/test-email', function () {
    $recipient = 'ashrafulunisoft@gmail.com'; // Using the specified email address for testing
    try {
        Mail::to($recipient)->send(new \App\Mail\TestEmail());
        return "Test email sent successfully to {$recipient}!";
    } catch (\Exception $e) {
        return "Error sending email: " . $e->getMessage();
    }
});

Route::get('/test-sms', function () {
    $phone = '01859385787'; // Using the specified phone number for testing
    $message = 'Test message from Bagisto SMS functionality!';
    $url = 'https://bulksmsbd.net/api/smsapi?api_key=KsNp0AcYqTNzTxCpoVA6&type=text&number=' . $phone . '&senderid=8809617611744&message=' . urlencode($message);

    try {
        $response = \Illuminate\Support\Facades\Http::get($url);

        if ($response->successful()) {
            return "SMS sent successfully to {$phone}! Response: " . $response->body();
        } else {
            return "Failed to send SMS! Status: " . $response->status() . " Response: " . $response->body();
        }
    } catch (\Exception $e) {
        return "Error sending SMS: " . $e->getMessage();
    }
});
