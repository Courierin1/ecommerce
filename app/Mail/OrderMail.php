<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $order1;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order1)
    {
        $this->order1=$order1;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order=$this->order1;
        return $this->view('site.order-details',compact('order'));
    }
}
