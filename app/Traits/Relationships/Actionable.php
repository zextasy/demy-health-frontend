<?php

namespace App\Traits\Relationships;

use App\Models\Task;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Actionable
{
    public function actionableTasks(): MorphMany
    {
        return $this->MorphMany(Task::class, 'actionable');
    }
}
