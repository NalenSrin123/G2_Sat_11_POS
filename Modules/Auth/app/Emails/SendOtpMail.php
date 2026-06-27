<?php

namespace Modules\Auth\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Login OTP',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'auth::email.otp',
            with: [
                'otp' => $this->otp
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}