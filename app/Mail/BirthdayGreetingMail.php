<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BirthdayGreetingMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public User $user)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Happy Birthday, '.$this->user->name.'!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.birthday-greeting',
            with: [
                'user' => $this->user,
            ],
        );
    }
}
