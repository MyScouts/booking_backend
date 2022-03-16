<?php

namespace App\Http\Controllers\Api\v1\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

trait IssueTokenTrait
{

    public function issueToken(Request $request, $grantType, $scope = "", $message = "Successful", $transId = 0)
    {

        $params = [
            'grant_type'    => $grantType,
            'client_id'     => $request->client_id,
            'client_secret' => $request->client_secret,
            'message'       => $message,
            'provider'      => $request->provider,
            'username'      => $request->email

        ];
        if ($grantType == 'password') {
            $params['scope']        = $scope;
            $params['deviceToken']  = isset($request->deviceToken) ? $request->deviceToken : '';
            $params['deviceId']     = isset($request->deviceId) ? $request->deviceId : '';
            $params['platform']     = isset($request->platform) ? $request->platform : '';
        } else {
            $params['access_token']     = isset($request->access_token) ? $request->access_token : '';
        }


        if (isset($request->provider_id) && isset($request->provider) && $grantType == 'password') {
            $params['email'] = $request->provider_id . '@' . $request->provider;
        } else {
            if (isset($request->email)) {
                $params['email'] = $request->email;
            } else {
                $params['email'] = bcrypt(Str::random(8));
            }
        }

        $request->request->add($params);
        $proxy = Request::create('api/auth/oauth/token', 'POST');
        return Route::dispatch($proxy);
    }
}
