<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log; // ✅ Import Log

class ContactEnquiryUserConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $subject_text;
    public $user_message;

    public function __construct($name, $subject_text, $user_message)
    {
        $this->name         = $name;
        $this->subject_text = $subject_text;
        $this->user_message = $user_message;

        Log::info('ContactEnquiryUserConfirmation::__construct called', [
            'name'    => $name,
            'subject' => $subject_text,
            'message' => $user_message,
        ]);
    }

    public function build()
{
    return $this->subject('Heni Chemicals: Contact Form Confirmation')
                ->view('emails.contact_user_confirmation')
                ->with([
                    'name'         => $this->name,
                    'subject_text' => $this->subject_text,
                    'user_message' => $this->user_message, // rename here
                ]);
}

}
