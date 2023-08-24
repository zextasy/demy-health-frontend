<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Task $task)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Task $task)
    {
        return $task->wasAssignedBy($user);
    }

    public function delete(User $user, Task $task)
    {
        return true;
    }

    public function restore(User $user, Task $task)
    {
        return true;
    }

    public function forceDelete(User $user, Task $task)
    {
        return true;
    }

    public function start(User $user, Task $task): bool
    {
        return $task->wasAssignedTo($user) && $task->canBeStarted();
    }

    public function requestCompletionConfirmation(User $user, Task $task)
    {
        return $task->wasAssignedTo($user) && $task->canBeCompleted();
    }

    public function reviewCompletionRequest(User $user, Task $task)
    {
        return $task->wasAssignedBy($user)  && $task->needsCompletionReview();
    }
}
