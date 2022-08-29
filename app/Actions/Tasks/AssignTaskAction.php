<?php

namespace App\Actions\Tasks;

use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Carbon;
use App\Contracts\AssignableContract;

class AssignTaskAction
{


    private ?int $assignedById = null;

    public function execute(AssignableContract $assignable, User| int $assignedTo, string $details, ?Carbon $dueAt) : Task
    {

        $assignedToId = $assignedTo instanceof User ? $assignedTo->id : $assignedTo;
        $task = new Task;
        $task->details = $details;
        $task->due_at = $dueAt ?? now()->addHours(2);
        $task->assignable_id = $assignable->id;
        $task->assignable_type = get_class($assignable);
        $task->assignable_url = $assignable->filament_url;
        $task->assigned_at = now();
        $task->assigned_by = $this->assignedById ?? auth()?->id() ?? 1;
        $task->assigned_to = $assignedToId;
        $task->save();

        return $task;
    }

    public function assignedBy(User| int $assignedBy): self
    {
        $this->assignedById = $assignedBy instanceof User ? $assignedBy->id : $assignedBy;
        return $this;
    }
}
