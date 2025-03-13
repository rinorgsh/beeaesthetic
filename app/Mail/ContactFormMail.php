<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactData;

    public function __construct($contactData)
    {
        $this->contactData = $contactData;
    }

    public function build()
    {
        return $this->subject('Nouveau message de contact')
                    ->from($this->contactData['email'])
                    ->view('emails.contact')
                    ->with([
                        'prenom' => $this->contactData['prenom'],
                        'nom' => $this->contactData['nom'],
                        'email' => $this->contactData['email'],
                        'messageBody' => $this->contactData['message']
                    ]);
    }
}