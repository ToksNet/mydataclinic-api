<?php

namespace App\Listeners;

// use Illuminate\Events\PasswordResetLinkSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetLinkMail;
use App\Events\PasswordResetLinkSent;

class SendPasswordResetLink
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PasswordResetLinkSent $event): void
    {
        $user = $event->user;
        $resetLink = $event->resetLink;
        

        // Send the email with the reset link
        Mail::to($user->business_email)->send(new PasswordResetLinkMail($user, $resetLink));
    }
}
