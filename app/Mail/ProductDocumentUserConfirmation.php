<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductDocumentUserConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $product_name;
    public $brand_name;
    public $sheet_title;
    public $document_name;
    public $file_path;
    public $pdf_display_name;

    /**
     * Create a new message instance.
     */
   public function __construct($product_name, $brand_name, $sheet_title, $document_name, $file_path)
{
    $this->product_name   = $product_name;
    $this->brand_name     = $brand_name;
    $this->sheet_title    = $sheet_title;
    $this->document_name  = $document_name;
    $this->file_path      = $file_path;

    // PDF name with sheet title in brackets
    $this->pdf_display_name = trim("{$brand_name} ({$sheet_title}).pdf");
}

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject("Your requested document: {$this->pdf_display_name}")
                    ->view('emails.product_document_user_confirmation')
                    ->attach($this->file_path, [
                        'as'   => $this->pdf_display_name, // Display name in email
                        'mime' => 'application/pdf',
                    ]);
    }
}
