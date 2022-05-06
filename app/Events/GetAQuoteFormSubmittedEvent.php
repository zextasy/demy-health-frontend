<?php

namespace App\Events;

use App\Models\CRM\CustomerEnquiry;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GetAQuoteFormSubmittedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public CustomerEnquiry $customerEnquiry;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(int $customerEnquiryId)
    {
        $customerEnquiry = CustomerEnquiry::find($customerEnquiryId);
        $this->customerEnquiry = $customerEnquiry;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
