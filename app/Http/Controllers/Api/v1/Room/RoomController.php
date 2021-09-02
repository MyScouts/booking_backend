<?php

namespace App\Http\Controllers\Api\v1\Room;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Room\RoomSearchReuqest;
use App\Http\Requests\RoomStoreRequest;
use App\Http\Resources\Room\RoomConlection;
use App\Services\RoomService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class RoomController extends Controller
{
    protected $service;

    public function __construct(RoomService $service)
    {
        $this->service = $service;
    }

    public function getAll(Request $reuqest)
    {
        $validator = Validator::make($reuqest->all(),[
            'pageSize' => 'nullable|numeric'
        ]);

        $rooms = $this->service->getAllRoom();

        return ResponseHelper::responseCallback(Response::HTTP_OK, 'create store successfull', true, new RoomConlection($rooms));
    }

    public function store(RoomStoreRequest $reuqest)
    {


        return ResponseHelper::responseCallback(Response::HTTP_OK, 'create store successfull', true);
    }

    protected function searchRules()
    {
        return [
            'pageSize' => 'nullable|numberic'
        ];
    }
}
