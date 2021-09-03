<?php

namespace App\Http\Controllers\Api\v1\Hotel;

use App\Http\Controllers\Controller;
use App\Services\HotelService;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    protected $service;
    public function __construct(HotelService $service)
    {
        $this->service = $service;
    }

    public function getDetail($id)
    {
        $hotel = $this->service->getDetail($id);

        return response()->json($hotel);
    }
}
