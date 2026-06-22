<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GuestInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $guest;
    public $link;

    /**
     * Create a new message instance.
     */
    public function __construct(\App\Models\Guest $guest)
    {
        $this->guest = $guest;
        $frontendUrl = config('app.frontend_url', 'http://localhost:3000');
        $this->link = "$frontendUrl/invite/{$guest->slug}";
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Undangan Pernikahan',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.guest_invitation',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
