<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DigitalProductPurchase extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🎉 Vos produits digitaux sont prêts !',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.digital-product-purchase',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}