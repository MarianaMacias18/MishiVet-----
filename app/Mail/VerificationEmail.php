<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerificationEmail extends Mailable 
{
    use Queueable, SerializesModels;

    public $user;
    public $verificationUrl; 

    public function __construct($user, $verificationUrl) // Acepta user y verificationUrl
    {
        $this->user = $user;
        $this->verificationUrl = $verificationUrl;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('mishivet@gmail.com','MishiVet'),
            subject: 'Verificación de correo electrónico',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'Emails.email',
        );
    }

    public function build()
    {
       
        return $this->markdown('Emails.email')
                    ->with([
                        'user' => $this->user,
                        'verificationUrl' => $this->verificationUrl,
                    ]);
    }
}
