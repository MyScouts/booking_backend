<?php

use App\Http\Controllers\Api\v1\Hotel\HotelController;

Route::group([
    'prefix'   => 'hotel',
], function () {

    Route::get('{id}', [HotelController::class, 'getDetail']);
});
