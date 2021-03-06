<?php

namespace App\Http\Controllers\Api\v1\Me;

use App\Domains\Auth\Services\UserService;
use App\Events\EventVerifyEmailWithOTP;
use App\Events\VerifyPhoneNumber;
use App\Helpers\CommonHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;
use Symfony\Component\HttpFoundation\Response;

class VerifyController extends Controller
{

    protected $service;
    public function __construct(UserService $service)
    {
        $this->service = $service;
        $this->middleware('auth:api');
    }

    public function sendMail()
    {
        if (auth()->user()->email) {
            $otp = CommonHelper::otpGenerate();
            event(new EventVerifyEmailWithOTP($otp, auth()->user()->email));
            return ResponseHelper::responseCallback(Response::HTTP_OK, 'The code has been sent to your email!', true);
        } else {
            return ResponseHelper::responseCallback(Response::HTTP_BAD_REQUEST, 'Your email is not exits', false);
        }
    }

    public function onVerifyEmail(Request $request)
    {
        $validator = $request->validate([
            'code' => 'required|numeric'
        ]);
        if ($this->getUser()->otp_email != $request->code) {
            return ResponseHelper::responseCallback(Response::HTTP_BAD_REQUEST, 'Code is not match', false);
        } else {
            $result = $this->service->selectUpdate(
                ['id' => $this->getUser()->id],
                ['email_verified_at' => now(), 'otp_email' => null]
            );
            if ($result) {
                return ResponseHelper::responseCallback(Response::HTTP_OK, 'Your email is verified', true);
            } else {
                return ResponseHelper::responseCallback(Response::HTTP_BAD_REQUEST, 'Server is error', false);
            }
        }
    }

    public function sendPhone()
    {
        if (auth()->user()->phone_number) {
            $otp = CommonHelper::otpGenerate();
            event(new VerifyPhoneNumber($otp, auth()->user()->phone_number));
            return ResponseHelper::responseCallback(Response::HTTP_OK, 'The code has been sent to your phone!', true);
        } else {
            return ResponseHelper::responseCallback(Response::HTTP_BAD_REQUEST, 'Your phone is not exits', false);
        }
    }

    public function onVerifyPhone(Request $request)
    {
        $validator = $request->validate([
            'code' => 'required|numeric'
        ]);
        if ($this->getUser()->otp_phonenumber != $request->code) {
            return ResponseHelper::responseCallback(Response::HTTP_BAD_REQUEST, 'Code is not match', false);
        } else {
            $result = $this->service->selectUpdate(
                ['id' => $this->getUser()->id],
                ['verify_phone_at' => now(), 'otp_phonenumber' => null]
            );
            if ($result) {
                return ResponseHelper::responseCallback(Response::HTTP_OK, 'Your email is verified', true);
            } else {
                return ResponseHelper::responseCallback(Response::HTTP_BAD_REQUEST, 'Server is error', false);
            }
        }
    }
}
