<?php

use App\Http\Controllers\Api\v1\Room\RoomController;

Route::group([
    'prefix' => 'room'
], function () {

    // create room
    Route::post('create', [RoomController::class, 'store']);
});
