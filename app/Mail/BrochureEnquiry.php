<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BrochureEnquiry extends Mailable
{
    use Queueable, SerializesModels;

    public $brochure_title;
    /*public $name;*/
    public $email;
    public $mobile_no;
    /*public $company_name;
    public $user_subject;*/

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($brochure_title, $email, $mobile_no)
    {
        $this->brochure_title = $brochure_title;
        /*$this->name = $name;*/
        $this->email = $email;
        $this->mobile_no = $mobile_no;
        /*$this->company_name = $company_name;
        $this->user_subject = $user_subject;*/
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Heni Chemicals | Brochure Enquiry Details')->view('emails.brochure-enquiry-details');
    }
}
