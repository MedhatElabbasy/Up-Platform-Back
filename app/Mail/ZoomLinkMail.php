<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ZoomLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    public $zoomLink;
    public $zoomPassword;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($zoomLink, $zoomPassword)
    {
        $this->zoomLink = $zoomLink;
        $this->zoomPassword = $zoomPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Zoom Link')->view('emails.zoom_link');
    }
}