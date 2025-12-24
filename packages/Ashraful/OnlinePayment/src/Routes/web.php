<?php

use Illuminate\Support\Facades\Route;
use Ashraful\OnlinePayment\Http\Controllers\PaymentController;

Route::prefix('online-payment')->middleware('web')->group(function () {
    Route::get('/redirect', [PaymentController::class, 'redirect'])
        ->name('online.payment.redirect');

    Route::post('/success', [PaymentController::class, 'success'])
        ->name('online.payment.success')
        ->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class);

    Route::post('/fail', [PaymentController::class, 'fail'])
        ->name('online.payment.fail')
        ->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class);

    Route::post('/cancel', [PaymentController::class, 'cancel'])
        ->name('online.payment.cancel')
        ->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class);

    Route::post('/ipn', [PaymentController::class, 'ipn'])
        ->name('online.payment.ipn')
        ->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class);
});
