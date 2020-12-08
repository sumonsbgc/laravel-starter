<?php

namespace App\Listeners;

use App\Events\EmailVerified;
use App\Mail\SendEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailVerificationMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  EmailVerified  $event
     * @return void
     */
    public function handle(EmailVerified $event)
    {
        if($event->user instanceof MustVerifyEmail && ! $event->user->hasVerifiedEmail()){
            Mail::to($event->user)->send(new SendEmail($event->user, $event->guard));
        }
    }
}
