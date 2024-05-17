<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use App\Models\Organisation;



class PasswordResetLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    public $notifiable;
    public $resetUrl;

    /**
     * Create a new message instance.
     */
    public function __construct($notifiable)
    {    

          
        $resetUrl = URL::temporarySignedRoute(
            'organisation.verify-token',
            Carbon::now()->addMinutes(60),
            // ['token' => $token],
            ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->business_email)]
        );
        


       
        $this->resetUrl = 'https://mydataclinic.com/auth/reset-password?token='.str_replace ('https://mydataclinic.com/analytics/public/api/v1/organisation/verify-token/', '', $resetUrl);
            $this->notifiable = $notifiable;
            // $this->user = $user;
        
        // $this->user = $user;
        // $this->resetLink = $resetLink;
         
    }

    // Build

    // public function build(): self
    // {
    //     return $this->subject('Your Password Reset Link')
    //         ->view('emails.password_reset_link')
    //         ->with([
    //             'user' => $this->user,
    //             'resetUrl' => $this->resetUrl,
    //         ]);

            
    // }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('no-reply@mydataclinic.com', 'MyDataClinic'),
            subject: 'Password Reset Link Mail',
           
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.password_reset_link',
            with: [
                'notifiable' => $this->notifiable,
                'resetUrl' => $this->resetUrl
            ],
        );
    } 

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
