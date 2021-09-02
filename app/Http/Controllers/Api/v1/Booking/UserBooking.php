<?php

namespace App\Http\Controllers\Api\v1\Booking;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserBooking extends Controller
{

    public function myBooking(Request $request)
    {
        return ResponseHelper::responseCallback(Response::HTTP_OK, 'successfull!', true);
    }
}
