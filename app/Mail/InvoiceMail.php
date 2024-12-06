<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $order_details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $order_details)
    {
        $this->order = $order;
        $this->order_details = $order_details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Invoice from Ecommerce')->view('mail.invoice');

    }
}
