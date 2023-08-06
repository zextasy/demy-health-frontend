<?php

namespace App\Actions\Tasks;

use App\Models\Task;

class RejectTaskCompletionConfirmationAction
{


    public function run(Task| int $task, bool $markAsFailed = false) : Task
    {
        $task = $task instanceof Task ? $task : Task::find($task);

        $task->update([
            'completion_confirmation_rejected_at' => now(),
            'completion_confirmation_rejected_by' => auth()->id(),
            'completion_confirmation_requested_at' => $markAsFailed ? $task->completion_confirmation_requested_at : null,
            'completion_confirmation_requested_by' => $markAsFailed ? $task->completion_confirmation_requested_by : null,
            'failed_at' => $markAsFailed ? now() : null,
            'failed_by' => $markAsFailed ? $task->assigned_to : null,
        ]);

        return $task;
    }

}
