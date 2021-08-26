<?php

use App\Http\Controllers\Api\v1\Auth\AccessTokenController;
use App\Http\Controllers\Api\v1\Auth\AuthVerifyController;
use App\Http\Controllers\Api\v1\Auth\LoginController;
use App\Http\Controllers\Api\v1\Auth\RegisterController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'auth'
], function () {
    Route::group([
        'prefix' => 'verify'
    ], function () {
        Route::post('email/send', [AuthVerifyController::class, 'verifyEmail']);
    });

    Route::post('oauth/token',  [AccessTokenController::class, 'issueToken']);
    Route::post('login',        [LoginController::class, 'login']);
    Route::post('register',     [RegisterController::class, 'register']);
});
