<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobEnquiry extends Mailable
{
    use Queueable, SerializesModels;

    public $job_title;
    public $name;
    public $email;
    public $mobile_no;
    public $document_src;
    public $about;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($job_title, $name, $email, $mobile_no, $document_src, $about)
    {
        $this->job_title = $job_title;
        $this->name = $name;
        $this->email = $email;
        $this->mobile_no = $mobile_no;
        $this->document_src = $document_src;
        $this->about = $about;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Heni Chemicals | Job Enquiry Details')->view('emails.job-enquiry-details')->attach($this->document_src);
    }
}
