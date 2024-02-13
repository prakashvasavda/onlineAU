<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FamilySignupNotification extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    public function __construct($data){
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Candidate From Your Location',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'user.mail_templetes.family.notification',
            with: [
                'area'                  => isset($this->data['area'])  ? $this->data['area']  : "",
                'role'                  => isset($this->data['role'])  ? $this->data['role']  : "",
                'name'                  => isset($this->data['name'])  ? $this->data['name']  : "",
                'childcare_experience'  => isset($this->data['childcare_experience']) ? $this->data['childcare_experience'] : "",
                'about_yourself'        => isset($this->data['about_yourself'])  ? $this->data['about_yourself']  : "",
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
