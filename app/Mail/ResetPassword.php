<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public function __construct($data){
        $this->data = $data;
    }

    
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Password Reset Request',
        );
    }

    
    public function content(): Content
    {
        return new Content(
            view: 'user.mail_templetes.candidate.reset_password',
            with: [
                'url'   => $this->data['url'],
                'name'  => $this->data['name'],
            ],
        );
    }

   
    public function attachments(): array
    {
        return [];
    }
}
