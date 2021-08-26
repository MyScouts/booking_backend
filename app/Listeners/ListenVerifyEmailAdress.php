<?php

namespace App\Listeners;

use App\Domains\Auth\Models\User;
use App\Events\EventVerifyEmailWithOTP;
use App\Http\Services\UserService;
use App\Mail\VerifyMailMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

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

        if ($result) {
            Mail::to($event->email)
                ->send(new VerifyMailMessage($event->otp));
        }
    }
}
