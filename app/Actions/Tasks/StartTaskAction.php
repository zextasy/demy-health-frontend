<?php

namespace App\Actions\Tasks;

use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Carbon;
use App\Contracts\AssignableContract;

class StartTaskAction
{


    public function run(Task| int $task) : Task
    {
        $task = $task instanceof Task ? $task : Task::find($task);

        $task->update([
            'started_at' => now(),
            'started_by' => auth()->id()
        ]);

        return $task;
    }

}
