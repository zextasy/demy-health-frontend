<?php

namespace App\Actions\Tasks;

use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Carbon;
use App\Contracts\AssignableContract;

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
