<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PhysicalProductPurchase extends Mailable
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
            subject: '✅ Commande confirmée - BEE AESTHETIC',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.physical-product-purchase',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}