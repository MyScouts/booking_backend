<?php

use App\Http\Controllers\Api\v1\Me\MeController;

Route::group([
    'middleware' => 'auth:api, verifyEmail'
], function () {
    Route::get('/profile', [MeController::class, 'profile']);
});
