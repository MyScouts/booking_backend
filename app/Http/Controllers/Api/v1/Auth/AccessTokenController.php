<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Domains\Auth\Models\User;
use App\Helpers\ResponseHelper;
use App\Models\Devices;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Passport\Exceptions\OAuthServerException;
use \Laravel\Passport\Http\Controllers\AccessTokenController as ATC;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Response;

class AccessTokenController extends ATC
{
    public function issueToken(ServerRequestInterface $request)
    {
        try {
            $email = $request->getParsedBody()['email'];
            $message = $request->getParsedBody()['message'];
            $user = User::where('email', $email)->first();

            $tokenResponse = parent::issueToken($request);
            $content = $tokenResponse->getContent();
            $data = json_decode($content, true);
            if (isset($data["error"])) {
                return ResponseHelper::responseCallback(Response::HTTP_BAD_REQUEST, 'User not found!', false);
            }
            if (!empty($user['id'])) {
                $deviceToken = $request->getParsedBody()['deviceToken'];
                $deviceId = $request->getParsedBody()['deviceId'];
                $platform = $request->getParsedBody()['platform'];
                if ($deviceToken != '' && $deviceId != '') {
                    $this->insertOrUpdateDevice($user['id'], $deviceToken, $deviceId, $platform);
                }
            }

            $user = collect($user);
            $user->put('access_token', $data['access_token']);
            $user->put('refresh_token', $data['refresh_token']);
            return ResponseHelper::responseCallback(Response::HTTP_OK, 'Login is successfull!', true, $user);
        } catch (ModelNotFoundException $e) {
        } catch (OAuthServerException $e) {
            return ResponseHelper::responseCallback(Response::HTTP_BAD_REQUEST, "The user credentials were incorrect!", false);
        } catch (Exception $e) {
            return ResponseHelper::responseCallback(Response::HTTP_BAD_REQUEST, $e->getMessage(), false);
        }
    }

    private function insertOrUpdateDevice($user_id, $deviceToken, $deviceId, $platform)
    {
        $device =  Devices::where('user_id', $user_id)->first();
        if ($device == null) {
            $n = new Devices;
            $n->user_id = $user_id;
            $n->device_token = $deviceToken;
            $n->device_id = $deviceId;
            // ios or android
            $n->device_type = $platform;
            $n->save();
        } else {
            $device->device_token = $deviceToken;
            $device->device_id = $deviceId;
            // ios or android
            $device->device_type = $platform;
            $device->save();
        }
        return true;
    }
}
