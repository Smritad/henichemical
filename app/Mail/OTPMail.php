<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OTPMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp; // public so it is accessible in the Blade view

    /**
     * Create a new message instance.
     *
     * @param int|string $otp
     */
    public function __construct($otp)
    {
        $this->otp = $otp; // store OTP in public property
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Heni Chemicals | OTP Verification')
                    ->view('emails.send-otp')
                    ->with([
                        'otp' => $this->otp, // pass OTP explicitly to view
                    ]);
    }
}
