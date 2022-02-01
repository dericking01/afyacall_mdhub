<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('emails.test');
        // return $this->subject($this->email->subject)
        //     ->view('emails.test')
        //     ->text('emails.test');
    //         return $this->from('test@afyacall.co.tz')
    //         ->to('mssmsfr@gmail.com')
    //         ->view('emails.test');

                return $this->subject('Mail from AfyaCall Center')
                ->view('emails.doctor-invention');
    }
}
