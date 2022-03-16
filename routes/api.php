<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('', function () {
    return response()->json('Hello');
});
require  __DIR__ . '/api/auth.php';
require __DIR__ . '/api/me.php';
require __DIR__ . '/api/room.php';
require __DIR__ . '/api/hotel.php';
