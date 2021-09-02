<?php

use App\Http\Controllers\Api\v1\Room\RoomController;

Route::group([
    'prefix' => 'room'
], function () {


    Route::get('all', [RoomController::class, 'getAll']);
    // create room
    Route::post('create', [RoomController::class, 'store']);
});
