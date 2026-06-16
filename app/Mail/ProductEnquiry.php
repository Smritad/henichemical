<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductEnquiry extends Mailable
{
    use Queueable, SerializesModels;

    // ✅ Renamed to avoid conflict with Laravel internals
    public $customer_name;
    public $product_name;
    public $customer_email;   // was: $email — conflicts with Mailable internals
    public $customer_mobile;
    public $customer_message;
    public $industry_type;
    public $brand_name;

    public function __construct(
        $name,
        $product_name,
        $email,
        $mobile_no,
        $user_message  = null,
        $industry_type = null,
        $brand_name    = null
    ) {
        $this->customer_name    = $name;
        $this->product_name     = $product_name;
        $this->customer_email   = $email;
        $this->customer_mobile  = $mobile_no;
        $this->customer_message = $user_message;
        $this->industry_type    = $industry_type;
        $this->brand_name       = $brand_name;
    }

    public function build()
    {
        return $this->subject('New Product Enquiry - ' . $this->product_name)
                    ->view('emails.product-enquiry');
    }
}