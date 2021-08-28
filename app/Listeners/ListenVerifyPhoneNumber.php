<?php

namespace App\Listeners;

use App\Events\VerifyPhoneNumber;
use App\Http\Services\UserService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Log;

class ListenVerifyPhoneNumber
{
    protected $uService;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserService $uService)
    {
        $this->uService = $uService;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(VerifyPhoneNumber $event)
    {
        $result = $this->uService->selectUpdate(['phone_number' => $event->phone], ['otp_phonenumber' => $event->otp]);
        Log::info("SEND PHONE", ['phone_number' => $event->phone, 'otp_phonenumber' => $event->otp, 'reusult' => $result]);
        if ($result) {
            // Nexmo::message()->send([
            //     'to' => '84702637656',
            //     'from' => '84848620369',
            //     'text' => 'addaddada'
            // ]);
        }
    }
}
