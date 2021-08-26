<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Services\UserService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    use IssueTokenTrait;


    protected $uService;
    public function __construct(UserService $uService)
    {
        $this->uService = $uService;
    }

    public function login(Request $request)
    {
        $request->validate([
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
