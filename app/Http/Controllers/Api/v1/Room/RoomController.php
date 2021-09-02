<?php

namespace App\Http\Controllers\Api\v1\Room;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoomStoreRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoomController extends Controller
{

    public function store(RoomStoreRequest $reuqest)
    {


        return ResponseHelper::responseCallback(Response::HTTP_OK, 'create store successfull', true);
    }
}
