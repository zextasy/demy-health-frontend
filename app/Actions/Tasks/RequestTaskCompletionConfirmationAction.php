<?php

namespace App\Actions\Tasks;

use App\Models\Task;
use App\Events\TaskCompletionApprovalRequestedEvent;

class RequestTaskCompletionConfirmationAction
{


    public function run(Task| int $task) : Task
    {
        $task = $task instanceof Task ? $task : Task::find($task);

        $task->update([
            'completion_confirmation_requested_at' => now(),
            'completion_confirmation_requested_by' => auth()->id()
        ]);

        $this->raiseEvents($task);
        return $task;
    }

    private function raiseEvents(Task $task): void
    {
        TaskCompletionApprovalRequestedEvent::dispatch($task);
    }

}
