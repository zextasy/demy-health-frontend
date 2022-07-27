<?php

namespace App\Notifications;

use App\Models\CRM\CustomerEnquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;
use Webbingbrasil\FilamentNotification\Actions\ButtonAction;
use Webbingbrasil\FilamentNotification\Notifications\NotificationLevel;

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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->subject)
            ->line($this->message)
            ->line($this->customerMessage)
            ->action('View Enquiry', $this->actionUrl)
            ->line('Please attend to this as soon as possible');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'level' => NotificationLevel::INFO,
            'title' => $this->subject,
            'message' => $this->message,
            'actionUrl' => $this->actionUrl,
        ];
    }

    public static function notificationFeedActions()
    {
        return [
            ButtonAction::make('viewEnquiry')
                ->label('View Enquiry')
                ->action(function ($record) {
                    $record->markAsRead();

                    return redirect()->to($record->data['actionUrl']);
                })
                ->outlined()
                ->color('blue'),
            ButtonAction::make('markRead')
                ->label('Mark as read')
                ->hidden(fn ($record) => $record->read()) // Use $record to access/update notification, this is DatabaseNotification model
                ->action(function ($record, $livewire) {
                    $record->markAsRead();
                    $livewire->refresh(); // $livewire can be used to refresh ou reset notification feed
                })
                ->outlined()
                ->color('secondary'),
        ];
    }
}
