<?php

namespace App\Notifications;

use App\Models\TestResult;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomerTestResultNotification extends Notification
{
    use Queueable;

    private TestResult $testResult;
    private string $subject;

    /**
     * Create a new notification instance.
     * @return void
     */
    public function __construct(TestResult $testResult)
    {
        $this->testResult = $testResult;
        $this->subject = 'Your results are ready';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        ray($this->testResult,$this->testResult->media, $this->testResult->media());
        return (new MailMessage)
            ->subject($this->subject)
            ->attach($this->testResult->media()->latest()->first()->getPath())
            ->view('emails.test-results.ready', ['result' => $this->testResult]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
