<?php

use Illuminate\Support\Facades\Route;
use Ashraful\OnlinePayment\Http\Controllers\PaymentController;

Route::prefix('online-payment')->middleware('web')->group(function () {
    Route::get('/redirect', [PaymentController::class, 'redirect'])
        ->name('online.payment.redirect');

    Route::post('/success', [PaymentController::class, 'success'])
        ->name('online.payment.success');

    Route::post('/fail', [PaymentController::class, 'fail'])
        ->name('online.payment.fail');

    Route::post('/cancel', [PaymentController::class, 'cancel'])
        ->name('online.payment.cancel');

    Route::post('/ipn', [PaymentController::class, 'ipn'])
        ->name('online.payment.ipn');
});
