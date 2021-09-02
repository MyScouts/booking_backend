<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Domains\Auth\Models\User;
use App\Domains\Auth\Services\UserService;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    use IssueTokenTrait;
    protected $uService;
    public function __construct(UserService $uService)
    {
        $this->uService = $uService;
    }

    public function register(Request $request)
    {
        $client_id = config('auth.client_id');
        $where = array(
            'id' => $client_id,
        );

        $client = $this->uService->checkClient($where);
        if ($client) {
            $request->client_id = $client_id;
            $request->client_secret = $client->secret;

            $user = array(
                'type' => 'user',
                'email' => $request->email,
                'name' => $request->name,
                'password' => Hash::make($request->password)
            );

            try {
                $result = User::insert($user);
                return $this->issueToken($request, 'password', '', '', 0);
            } catch (\Throwable $th) {
                return ResponseHelper::responseCallback(Response::HTTP_OK, $th->getMessage(), false);
            }
        }
    }
}
