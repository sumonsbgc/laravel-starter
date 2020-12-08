<?php

namespace App\Mail;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
    public User $user;
    public string $guard;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $guard)
    {
        $this->user = $user;
        $this->guard = $guard;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $verifyRoute = "{$this->guard}.verification.verify";

        $url = URL::temporarySignedRoute(
            $verifyRoute,
            Carbon::now()->addMinutes(config()->get('auth.verification.expire', 60)),
            [
                'id' => $this->user->id,
                'hash' => sha1($this->user->getEmailForVerification()),
            ]
        );
        return $this->subject('Email Verification Mail')
                    ->view('emails.email_verification', ["url" => $url, "name" => $this->user->name]);
    }
}
