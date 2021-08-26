<?php

use App\Http\Controllers\Api\Auth\AuthVerifyController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'verify'
], function () {
    Route::post('email/send', [AuthVerifyController::class, 'verifyEmail']);
});
