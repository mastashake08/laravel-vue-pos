<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscriptionActivation extends Mailable
{
    use Queueable, SerializesModels;

    public $customer,$plan;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer, $plan)
    {
        //
        $this->customer = $customer;
        $this->plan = $plan;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.subscriptions.activate');
    }
}
