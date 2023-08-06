<?php

namespace App\Actions\Tasks;

use App\Models\Task;

class RequestTaskCompletionConfirmationAction
{


    public function run(Task| int $task) : Task
    {
        $task = $task instanceof Task ? $task : Task::find($task);

        $task->update([
            'completion_confirmation_requested_at' => now(),
            'completion_confirmation_requested_by' => auth()->id()
        ]);

        return $task;
    }

}
