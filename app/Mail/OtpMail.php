<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Bus\Queueable;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;

    /* ================= CONSTRUCTOR ================= */

    public function __construct($otp)
    {
        $this->otp = $otp;
    }


    /* ================= EMAIL SUBJECT ================= */

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your OTP Verification Code'
        );
    }


    /* ================= EMAIL CONTENT ================= */

    public function content(): Content
    {
        return new Content(
            view: 'emails.otp',
            with: [
                'otp' => $this->otp
            ]
        );
    }


    /* ================= ATTACHMENTS ================= */

    public function attachments(): array
    {
        return [];
    }
}
