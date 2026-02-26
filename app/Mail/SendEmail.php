<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
    public function __construct(public string $token,public string $colocationName)
    {
        //
    }
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'This is a invitation to join : '.$this->colocationName,
        );
    }
    public function content(): Content
    {
        return new Content(
            view: 'client.Email.invitation',
        );
    }
    public function attachments(): array
    {
        return [];
    }
}
