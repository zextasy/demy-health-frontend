<?php

namespace App\Actions\Tasks;

use App\Models\Task;
use App\Events\TaskCompletedEvent;
use App\Events\TaskCompletionRequestConfirmedEvent;

class ApproveTaskCompletionConfirmationAction
{


    public function run(Task| int $task, int $rating = 0) : Task
    {
        $task = $task instanceof Task ? $task : Task::find($task);

        $requestedAt = $task->completion_confirmation_requested_at;
        $requestedBy = $task->completion_confirmation_requested_by;

        $task->update([
            'completed_at' => $requestedAt,
            'completed_by' => $requestedBy,
            'completion_rating' => $rating,
            'completion_confirmation_approved_at' => now(),
            'completion_confirmation_approved_by' => auth()->id(),
            'completion_confirmation_requested_at' => null,
            'completion_confirmation_requested_by' => null,
        ]);

        $this->raiseEvents($task);
        return $task;
    }

    private function raiseEvents(Task $task): void
    {
        TaskCompletionRequestConfirmedEvent::dispatch($task);
        TaskCompletedEvent::dispatch($task);
    }
}
