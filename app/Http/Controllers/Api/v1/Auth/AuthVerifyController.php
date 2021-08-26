<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Domains\Auth\Models\User;
use App\Events\EventVerifyEmailWithOTP;
use App\Helpers\CommonHelper;
use App\Helpers\ResponseHelper;
use App\Helpers\StatusCodeHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\VerifyEmailRequest;

class AuthVerifyController extends Controller
{
    public function verifyEmail(VerifyEmailRequest $request)
    {
        $checkMailExit = User::where('email', $request->email)->exists();
        if ($checkMailExit) {
            $otp = CommonHelper::otpGenerate();
            event(new EventVerifyEmailWithOTP($otp, $request->email));
            return ResponseHelper::responseCallback(StatusCodeHelper::$SUCCESS, 'The code has been sent to your email!', true);
        } else {
            return ResponseHelper::responseCallback(StatusCodeHelper::$BAD_REQUEST, 'Email does not exist on the system!', false);
        }
    }
}
