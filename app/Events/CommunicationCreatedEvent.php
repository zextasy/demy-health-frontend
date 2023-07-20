<?php

namespace App\Events;


use App\Models\Communication\Communication;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CommunicationCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Communication $communication;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Communication $communication)
    {
        $this->communication = $communication;
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
