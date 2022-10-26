<?php

namespace App\Notifications;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use App\Models\CRM\CustomerEnquiry;
use Illuminate\Notifications\Notification;
use Filament\Notifications\Actions\Action;
use Illuminate\Notifications\Messages\MailMessage;
use Filament\Notifications\Notification as FilamentNotification;

class InternalCustomerEnquiryNotification extends Notification
{
    use Queueable;

    private string $subject;

    private string $message;

    private mixed $customerMessage;

    private mixed $actionUrl;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(CustomerEnquiry $customerEnquiry)
    {
        $this->subject = 'An enquiry has been made';
        $enquiryTypeTitle = Str::camelCaseToWords($customerEnquiry->type->name);
        $enquiryTypeLower = Str::lower($enquiryTypeTitle);
        $this->message = "A {$enquiryTypeLower} enquiry was made by a customer, {$customerEnquiry->customer_name} , email: {$customerEnquiry->customer_email}";
        $this->customerMessage = $customerEnquiry->customer_message;
        $this->actionUrl = $customerEnquiry->filament_url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->subject)
            ->line($this->message)
            ->line($this->customerMessage)
            ->action('View Enquiry', $this->actionUrl)
            ->line('Please attend to this as soon as possible');
    }

    public function toDatabase($notifiable): array
    {
        return FilamentNotification::make()
            ->title($this->subject)
            ->body($this->message)
            ->actions([
                Action::make('View Enquiry')
                    ->button()
                    ->url($this->actionUrl),
            ])
            ->getDatabaseMessage();
    }

    public function toArray($notifiable)
    {
        return [
            'title' => $this->subject,
            'message' => $this->message,
            'actionUrl' => $this->actionUrl,
        ];
    }

}
