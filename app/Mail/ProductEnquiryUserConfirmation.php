<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductEnquiryUserConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $product_name;
    public $industry_type;

    public function __construct($name, $product_name, $industry_type = null)
    {
        $this->name          = $name;
        $this->product_name  = $product_name;
        $this->industry_type = $industry_type;
    }

    public function build()
    {
        return $this->subject('Thank You for Your Enquiry - ' . $this->product_name)
                    ->view('emails.product-enquiry-user-confirmation');
    }
}