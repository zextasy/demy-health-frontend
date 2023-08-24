<?php

namespace App\Actions\Tasks;

use App\Models\Task;
use App\Contracts\ActionableContract;
use App\Events\TaskActionableAssignedEvent;

class AttachTaskActionableAction
{


    public function run(Task| int $task, ActionableContract $actionableContract) : Task
    {
        $task = $task instanceof Task ? $task : Task::find($task);

        $task->update([
            'actionable_type' => $actionableContract->getLaravelMorphModelType(),
            'actionable_id' => $actionableContract->getLaravelMorphModelId(),
            'assignable_url' => $actionableContract->getFilamentUrl()
        ]);

        $this->raiseEvents($task, $actionableContract);
        return $task;
    }

    private function raiseEvents(Task $task, ActionableContract $actionableContract): void
    {
        TaskActionableAssignedEvent::dispatch($task, $actionableContract);
    }

}
