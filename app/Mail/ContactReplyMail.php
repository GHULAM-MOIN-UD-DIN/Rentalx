<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactName;
    public $contactEmail;
    public $originalMessage;
    public $adminReply;
    public $subject;

    public function __construct($contactName, $contactEmail, $originalMessage, $adminReply, $subject = null)
    {
        $this->contactName     = $contactName;
        $this->contactEmail    = $contactEmail;
        $this->originalMessage = $originalMessage;
        $this->adminReply      = $adminReply;
        $this->subject         = $subject ?? 'Reply to Your Inquiry';
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Re: ' . $this->subject . ' · RENTALX',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact_reply',
            with: [
                'contactName'     => $this->contactName,
                'originalMessage' => $this->originalMessage,
                'adminReply'      => $this->adminReply,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
