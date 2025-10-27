<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;

class OrderThankYouMail extends Mailable
{
    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    // Envelope: onderwerp, afzender, etc.
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bedankt voor je bestelling!',
        );
    }

    // Content: welke view wordt gebruikt
    public function content(): Content
    {
        return new Content(
            view: 'emails.order-thank-you',
        );
    }
}

