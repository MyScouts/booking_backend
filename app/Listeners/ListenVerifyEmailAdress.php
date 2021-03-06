<?php

namespace App\Listeners;

use App\Domains\Auth\Models\User;
use App\Domains\Auth\Services\UserService;
use App\Events\EventVerifyEmailWithOTP;
use App\Mail\VerifyMailMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Log;

class ListenVerifyEmailAdress
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    protected $service;
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(EventVerifyEmailWithOTP $event)
    {
        $result = $this->service->selectUpdate(['email' => $event->email], ['otp_email' => $event->otp]);
        Log::info("SEND MAIL", ['email' => $event->email, 'otp_email' => $event->otp, 'reusult' => $result]);
        if ($result) {
            Mail::to($event->email)
                ->send(new VerifyMailMessage($event->otp));
        }
    }
}
