<?php

namespace App\Events;

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

    public string $customerEmail;
    public string $customerName;
    public string $message;
    public int $addressId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $customerEmail, string $customerName, string $message, int $addressId)
    {
        $this->customerEmail = $customerEmail;
        $this->customerName = $customerName;
        $this->message = $message;
        $this->addressId = $addressId;
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
