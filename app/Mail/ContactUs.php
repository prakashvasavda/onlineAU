<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    
    public function __construct($data){
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact Us',
        );
    }

   
    public function content(): Content
    {
        return new Content(
            view: 'user.mail_templetes.cantact_us',
            with: [
                'number'    => isset($this->data['number'])  ? $this->data['number']  : null,
                'name'      => isset($this->data['name'])  ? $this->data['name']  : null,
                'email'     => isset($this->data['email']) ? $this->data['email'] : null,
                'messages'  => isset($this->data['message']) ? $this->data['message'] : null,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
