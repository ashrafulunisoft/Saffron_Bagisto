<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Test email and SMS integration
Route::get('/test-email', function () {
    $recipient = 'ashrafulunisoft@gmail.com'; // Using specified email address for testing
    try {
        Mail::to($recipient)->send(new \App\Mail\TestEmail());
        return "Test email sent successfully to {$recipient}!";
    } catch (\Exception $e) {
        return "Error sending email: " . $e->getMessage();
    }
});


//Test SMS
Route::get('/test-sms-service', function () {
    try {
        $smsService = app(\Webkul\Admin\Services\SmsService::class);

        // Test SMS sending
        $result = $smsService->sendSms(
            '01859385787',
            'Test message from SmsService - Integration successful!'
        );

        return "SMS Service Test: " . ($result ? 'Success' : 'Failed');
    } catch (\Exception $e) {
        return "Error testing SMS Service: " . $e->getMessage();
    }
});
