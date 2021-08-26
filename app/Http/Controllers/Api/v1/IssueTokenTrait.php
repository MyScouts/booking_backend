<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

trait IssueTokenTrait
{

    public function issueToken(Request $request, $grantType, $scope = "", $message = "Successful", $transId = 0)
    {

        $params = [
            'grant_type' => $grantType,
            'client_id' => $request->client_id,
            'client_secret' => $request->client_secret,
            'scope' => $scope,
            'message' => $message,
            'provider' => 'users',
            'username' => $request->email,
            'deviceToken' => isset($request->deviceToken) ? $request->deviceToken : '',
            'deviceId' => isset($request->deviceId) ? $request->deviceId : '',
            'platform' => isset($request->platform) ? $request->platform : '',
        ];
        if (isset($request->provider_id) && isset($request->provider)) {
            $params['email'] = $request->provider_id . '@' . $request->provider;
        } else {
            if (isset($request->email)) {
                $params['email'] = $request->email;
            } else {
                $params['email'] = bcrypt(Str::random(8));
            }
        }

        $request->request->add($params);
        $proxy = Request::create('api/oauth/token', 'POST');
        return Route::dispatch($proxy);
    }
}
