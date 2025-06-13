<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HelpMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $name;
    public string $email;
    public string $messageText;
    public string $type;

    public function __construct(string $name, string $email, string $messageText, string $type)
    {
        $this->name = $name;
        $this->email = $email;
        $this->messageText = $messageText;
        $this->type = $type;
    }

    public function build(): HelpMessageMail
    {
        return $this->subject("New Help Message: {$this->type}")
            ->view('emails.help-message');
    }
}
