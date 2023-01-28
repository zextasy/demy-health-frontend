<?php

namespace App\Mail;

use App\Models\Communication\Communication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommunicationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;

    public string $content;

    public Communication $communication;

    public ?string $replyToAddress;

    public function __construct(Communication $communication)
    {
        $this->communication = $communication;
        $this->subject = $communication->subject;
        $this->content = $communication->content;
        $this->replyToAddress = $communication->reply_to;
    }

    public function build(): self
    {
        $email = $this->subject($this->subject)
            ->view('emails.communication')
            ->with(['content' => $this->content]);

        if (! empty($this->replyToAddress)) {
            $email->replyTo($this->replyToAddress);
        }

        return $email;
    }
}
