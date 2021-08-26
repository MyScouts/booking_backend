<?php

namespace App\Helpers;

class CommonHelper
{

    public static function otpGenerate()
    {
        $number = env('OTP_NUMBER', 4);

        switch ($number) {
            case 4:
                $otp = rand(1000, 9999);
                return $otp;
                break;
            default:
                return 0;
                break;
        }
    }
}
