<?php

use App\Http\Controllers\Api\v1\Auth\AccessTokenController;
use App\Http\Controllers\Api\v1\Auth\AuthVerifyController;
use App\Http\Controllers\Api\v1\Auth\LoginController;
use App\Http\Controllers\Api\v1\Auth\RefreshController;
use App\Http\Controllers\Api\v1\Auth\RegisterController;
use App\Http\Controllers\Api\v1\Me\VerifyController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'auth'
], function () {
    Route::group([
        'prefix' => 'verify',
        'middleware' => 'auth:api'
    ], function () {
        Route::post('email', [VerifyController::class, 'onVerifyEmail']);
        Route::post('email/send', [VerifyController::class, 'sendMail']);
        Route::post('phone', [VerifyController::class, 'onVerifyPhone']);
        Route::post('phone/send', [VerifyController::class, 'sendPhone']);
    });

    Route::post('oauth/token',  [AccessTokenController::class, 'issueToken']);
    Route::post('login',        [LoginController::class, 'login']);
    Route::post('register',     [RegisterController::class, 'register']);
    Route::post('refresh',      [RefreshController::class, 'refresh']);
});
