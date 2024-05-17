<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;
use App\Mail\RegisterMail;
use Illuminate\Support\Carbon;

class VerifyOrganisationEmail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable)
    // : MailMessage
    {

        return (new RegisterMail($notifiable))
        ->to($notifiable->business_email);

        // return (new MailMessage)
        // ->subject('Verify Your Email Address')
        // ->line('Please click the button below to verify your email address.')
        // ->action('Verify Email', $this->verificationUrl($notifiable));
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(10),
            ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->getEmailForVerification())]
        );
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
