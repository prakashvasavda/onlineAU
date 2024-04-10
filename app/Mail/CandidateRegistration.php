<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CandidateRegistration extends Mailable{

    use Queueable, SerializesModels;

    public $data;

    public function __construct($data){
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Candidate Registration',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'user.mail_templetes.candidate.registration',
            with: [
                'role'    => isset($this->data['role'])  ? $this->data['role']  : null,
                'name'    => isset($this->data['name'])  ? $this->data['name']  : null,
                'email'   => isset($this->data['email']) ? $this->data['email'] : null,
                'date'    => date("Y-m-d H:i:s"),
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
