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

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    
    /**
     * Create a new message instance.
     */
    public $notifiable;
    public $verificationUrl;

    public function __construct($notifiable)
    {
        
        $verificationUrl = URL::temporarySignedRoute(
            'organisation.verify',
            Carbon::now()->addMinutes(60),
            ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->business_email)]
        );
        $this->notifiable = $notifiable; 
        $this->verificationUrl = 'https://mydataclinic.com/auth/verification?token='.str_replace('https://mydataclinic.com/analytics/public/api/v1/organisation/verify/', '', $verificationUrl);
        
        
    }

    // public function build()
    // {
    //       return $this->subject('Email Verification Required')
    //             ->to($this->notifiable->business_email) // Use business_email instead of email
    //             ->view('emails.verify_email', [
    //                 'notifiable' => $this->notifiable,
    //                 'verificationUrl' => $this->verificationUrl
    //             ]);
    // }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('no-reply@mydataclinic.com', 'MyDataClinic'),
            subject: 'Email Verification Required',
           
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.verify_email',
            with: [
                'notifiable' => $this->notifiable,
                'verificationUrl' => $this->verificationUrl
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
