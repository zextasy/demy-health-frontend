<?php

namespace App\Actions\Tasks;

use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Carbon;
use App\Contracts\AssignableContract;

class RejectTaskCompletionConfirmationAction
{


    public function execute(Task| int $task, bool $markAsFailed = false) : Task
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
