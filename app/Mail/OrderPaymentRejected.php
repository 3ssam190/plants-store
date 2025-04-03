<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderPaymentRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $reason;

    public function __construct(Order $order, $reason = null)
    {
        $this->order = $order;
        $this->reason = $reason;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Payment Rejected - Order #'.$this->order->id,
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.order_payment_rejected',
        );
    }
}