<?php

use App\Http\Controllers\Api\v1\Booking\UserBookingController;
use App\Http\Controllers\Api\v1\Me\MeController;

Route::group([
    'prefix'    => 'me',
    'middleware' => ['auth:api', 'isUser', 'verifyEmail']
], function () {
    Route::get('',                  [MeController::class, 'profile']);
    Route::get('/booking',          [UserBookingController::class, 'myBooking']);
    Route::post('/booking/create',  [UserBookingController::class, 'createBooking']);
});

// verifyEmail,isUser
