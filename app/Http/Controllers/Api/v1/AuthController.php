<?php

namespace App\Http\Controllers\Api\v1;

use App\Helpers\ResponseHelper;
use App\Helpers\StatusCodeHelper;
use App\Http\Controllers\Controller;
use App\Http\Services\UserService;
use Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    use IssueTokenTrait;


    protected $uService;
    public function __construct(UserService $uService)
    {
        $this->uService = $uService;
    }

    public function login(Request $request)
    {
        $login = $request->validate([
            'email' => 'required|email',
            'password'  => 'required|string'
        ]);

        $client_id = config('auth.client_id');
        $where = array(
            'id' => $client_id,
        );

        $client = $this->uService->checkClient($where);
        if ($client) {
            $request->client_id = $client_id;
            $request->client_secret = $client->secret;
            return $this->issueToken($request, 'password', '', '', 0);
        } else {
            return ResponseHelper::responseCallback(Response::HTTP_OK, 'The client credentials were incorrect.', false);
        }
    }
}
