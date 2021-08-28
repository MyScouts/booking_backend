<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Services\UserService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Validator;

class RefreshController extends Controller
{

    use IssueTokenTrait;


    protected $uService;
    public function __construct(UserService $uService)
    {
        $this->uService = $uService;
    }

    public function refresh(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'refresh_token' => 'required'
        ]);

        if ($validator->fails()) {
            return ResponseHelper::responseCallback(Response::HTTP_BAD_REQUEST, 'Invalid', false);
        }

        $client_id = config('auth.client_id');
        $where = array(
            'id' => $client_id,
        );
        $client = $this->uService->checkClient($where);
        if ($client) {
            $request->client_id = $client_id;
            $request->client_secret = $client->secret;
            return $this->issueToken($request, 'refresh_token');
        } else {
            return response(["code" => 103, 'message' => 'The client credentials were incorrect.', 'success' => false, 'data' => null], Response::HTTP_BAD_REQUEST);
        }
    }
}
