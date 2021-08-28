<?php

namespace App\Http\Controllers\Api\v1\Me;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:api', 'verifyEmail']);
    }

    public function profile()
    {
        if ($this->getUser()->delete_at) {
            return ResponseHelper::responseCallback(Response::HTTP_BAD_REQUEST, 'User has been deleted!', false);
        } else {
            return ResponseHelper::responseCallback(Response::HTTP_OK, 'successfull!', true, $this->getUser());
        }
    }
}
