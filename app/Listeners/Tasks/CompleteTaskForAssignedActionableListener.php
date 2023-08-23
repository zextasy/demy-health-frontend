<?php

namespace App\Listeners\Tasks;

use App\Enums\Tasks\TaskActionEnum;
use App\Actions\Tasks\CompleteTaskAction;
use App\Events\TaskActionableAssignedEvent;

class CompleteTaskForAssignedActionableListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(TaskActionableAssignedEvent $event)
    {
        $taskToStart = $event->task;
        if ($taskToStart->action == TaskActionEnum::CREATE){
            (new CompleteTaskAction)->run($taskToStart, $taskToStart->assignedTo);
        }
    }
}
