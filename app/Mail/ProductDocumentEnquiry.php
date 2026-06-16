<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductDocumentEnquiry extends Mailable
{
    use Queueable, SerializesModels;

    public $product_name;
    public $brand_name;
    public $sheet_title;
    public $pdf_display_name;
    public $email;
    public $mobile_no;

    // Added $pdf_display_name parameter
    public function __construct($product_name, $brand_name, $sheet_title, $email, $mobile_no, $pdf_display_name)
    {
        $this->product_name = $product_name;
        $this->brand_name = $brand_name;
        $this->sheet_title = $sheet_title;
        $this->pdf_display_name = $pdf_display_name;
        $this->email = $email;
        $this->mobile_no = $mobile_no;
    }

    public function build()
    {
        return $this->subject('Heni Chemicals | Product Document Enquiry Details')
                    ->view('emails.product-document-enquiry-details');
    }
}
