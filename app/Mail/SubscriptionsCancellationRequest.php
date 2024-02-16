<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscriptionsCancellationRequest extends Mailable
{
    use Queueable, SerializesModels;

  
    public $data;
    
    public function __construct($data){
        $this->data = $data;
    }
    
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Subscriptions Cancellation Request',
        );
    }

    
    public function content(): Content
    {
        return new Content(
            view: 'user.mail_templetes.family.subscription-cancellation-request',
            with: [
                'name'           => Session::get("frontUser")->name ?? null,
                'package_name'   => $this->data['package_name'] ?? null
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
