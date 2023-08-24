<?php

namespace App\Actions\Tasks;

use App\Models\Task;
use App\Models\User;
use App\Events\TaskCompletedEvent;

class CompleteTaskAction
{


    public function run(Task| int $task, User| int | null $user = null) : Task
    {
        $task = $task instanceof Task ? $task : Task::find($task);
        $userId = auth()->id();
        if (isset($user)){
            $userId = $user instanceof User ? $user->id : $user;
        }

        $task->update([
            'completed_at' => now(),
            'completed_by' => $userId
        ]);

		$this->raiseEvents($task);
        return $task;
    }

	private function raiseEvents(Task $task): void
	{
        TaskCompletedEvent::dispatch($task);
	}

}
