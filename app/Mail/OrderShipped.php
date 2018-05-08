<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $sendMailData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
       // $this->sendMailData = $sendMailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('__layout.emali');
                    // ->with('sendMailData', $this->sendMailData);
    }
}
