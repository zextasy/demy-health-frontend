<?php

namespace App\Traits\Relationships;

use App\Models\Task;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Assignable
{
    public function tasks(): MorphMany
    {
        return $this->MorphMany(Task::class, 'assignable');
    }
}
