<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Domains\Auth\Models\User;
use App\Domains\Auth\Services\UserService;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\LinkedSocialAccount;
use DB;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
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
            $request->provider =  'users';
            return $this->issueToken($request, 'password', '', 'successfull!', 0);
        } else {
            return ResponseHelper::responseCallback(Response::HTTP_OK, 'The client credentials were incorrect.', false);
        }
    }

    public function socialLogin(Request $request)
    {
        $request->validate([
            'access_token'  => 'required|string',
            'provider'      => 'required|string'
        ]);
        $facebook = Socialite::driver('facebook')->userFromToken($request->access_token);
        $linkedSocialAccount = LinkedSocialAccount::where('provider_name', $request->provider)
            ->where('provider_id', $facebook->getId())
            ->first();
        if (!$linkedSocialAccount) {
            $user = null;
            if ($email = $facebook->getEmail()) {
                $user = User::where('email', $email)->first();
            }
            if (!$user) {
                $user = User::create([
                    'first_name' => $facebook->getName(),
                    'last_name' => $facebook->getName(),
                    'name' => $facebook->getName(),
                    'email' => $facebook->getEmail(),
                    'email_verified_at' => now()
                ]);
            }
            $user->linkedSocialAccounts()->create([
                'provider_id' => $facebook->getId(),
                'provider_name' => $request->provider,
            ]);
        }

        $request->email = $facebook->getEmail();
        return $this->issueToken($request, 'social', '', '', 0);
    }
}
