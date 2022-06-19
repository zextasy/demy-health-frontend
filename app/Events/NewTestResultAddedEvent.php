<?php

namespace App\Events;

use App\Models\TestResult;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class NewTestResultAddedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public TestResult $testResult;

    /**
     * Create a new event instance.
     * @return void
     */
    public function __construct(TestResult $testResult)
    {
        $this->testResult = $testResult;
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
