<?php

use App\Http\Controllers\Api\Auth\AuthVerifyController;
use App\Http\Controllers\Api\v1\AccessTokenController;
use App\Http\Controllers\Api\v1\Auth\RegisterController;
use App\Http\Controllers\Api\v1\AuthController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'verify'
], function () {
    Route::post('email/send', [AuthVerifyController::class, 'verifyEmail']);
});

Route::post('login',        [AuthController::class, 'login']);
Route::post('register',     [RegisterController::class, 'register']);
Route::post('oauth/token',  [AccessTokenController::class, 'issueToken']);
