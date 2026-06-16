<?php
namespace App\Mail;

use Illuminate\Mail\Mailable;

class BrochureUserConfirmation extends Mailable
{
    public $title;
    public $pdfPath;

    public function __construct($title, $pdfPath)
    {
        $this->title   = $title;
        $this->pdfPath = $pdfPath;
    }

    public function build()
    {
        return $this->subject('Your Brochure Download - Heni Chemicals')
            ->view('emails.brochure_user_confirmation')
            ->attach($this->pdfPath, [
                'as'   => $this->title.'.pdf',
                'mime' => 'application/pdf',
            ]);
    }
}
