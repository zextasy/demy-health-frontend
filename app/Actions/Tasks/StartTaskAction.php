<?php

namespace App\Actions\Tasks;

use App\Models\Task;
use App\Events\TaskStartedEvent;

class StartTaskAction
{


    public function run(Task| int $task) : Task
    {
        $task = $task instanceof Task ? $task : Task::find($task);

        $task->update([
            'started_at' => now(),
            'started_by' => auth()->id()
        ]);

		$this->raiseEvents($task);
        return $task;
    }

	private function raiseEvents(Task $task): void
	{
		TaskStartedEvent::dispatch($task);
	}

}
