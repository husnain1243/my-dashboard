<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GiftMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $type;

    /**
     * Create a new message instance.
     */
    public function __construct($json, $type)
    {
        //
        $this->data = json_decode($json);
        $this->type = $type;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        if($this->type == "Sender"){
            return new Envelope(
                subject: 'Your Gift Has Been Delivered Successfully!',
            );
        }
        if($this->type == "Receiver"){
            return new Envelope(
                subject: 'Your Dream Website Has Arrived, Courtesy of Startup Assistant!',
            );
        }

    }

    /**
     * Get the message content definition.
     */

    public function content(): Content
    {
        if($this->type == "Sender"){

            return new Content(
                view: 'emails.sender',
                with: [
                    "data" => $this->data
                ]
            );
        }
        if($this->type == "Receiver"){

            return new Content(
                view: 'emails.receiver',
                with: [
                    "data" => $this->data
                ]
            );
        }
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
