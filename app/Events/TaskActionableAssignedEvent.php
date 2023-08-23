<?php

namespace App\Events;


use App\Models\Task;
use App\Contracts\ActionableContract;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class TaskActionableAssignedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Task $task;
    public ActionableContract $actionable;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(int|Task $task, ActionableContract $actionable)
    {
        $this->task = $task instanceof Task ? $task : Task::findOrFail($task);
        $this->actionable = $actionable;
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
