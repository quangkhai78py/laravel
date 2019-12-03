<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $cart;
    public $data_user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($cart,$data_user)
    {
        $this->cart = $cart;
        $this->data_user = $data_user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('frontend.email.sendmail');
    }
}
