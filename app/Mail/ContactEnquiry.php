<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactEnquiry extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $mobile_no;
    public $user_subject;
    public $user_message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $mobile_no, $user_subject, $user_message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->mobile_no = $mobile_no;
        $this->user_subject = $user_subject;
        $this->user_message = $user_message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Heni Chemicals | Enquiry Details')->view('emails.contact-us-enquiry-details');
    }
}
