<?php

namespace App\Events;

use App\Models\CRM\CustomerEnquiry;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ContactUsFormSubmittedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public CustomerEnquiry $customerEnquiry;

    /**
     * Create a new event instance.
     * @return void
     */
    public function __construct(int $customerEnquiryId)
    {
        $customerEnquiry = CustomerEnquiry::find($customerEnquiryId);
        $this->customerEnquiry = $customerEnquiry;
    }

    /**
     * Get the channels the event should broadcast on.
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
