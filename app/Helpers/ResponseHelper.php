<?php
namespace App\Helpers;

class ResponseHelper
{

    public static function responseCallback($status, $message, $success, $data = null)
    {
        return response()->json([
            "status"    => $status,
            "message"   => $message,
            "success"   => $success,
            "data"      => $data
        ]);
    }
}
