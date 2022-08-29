<?php

namespace App\Traits\Relationships;

use App\Models\Task;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

trait HasTasks
{
    use HasRelationships;

    public function tasksForSupervision(): HasMany
    {
        return $this->hasMany(Task::class,'assigned_by');
    }

    public function tasksForAttention(): HasMany
    {
        return $this->hasMany(Task::class,'assigned_to');
    }

    public function tasksInProgress(): HasMany
    {
        return $this->hasMany(Task::class,'started_by');
    }

    public function completedTasks(): HasMany
    {
        return $this->hasMany(Task::class,'completed_by');
    }

    public function failedTasks(): HasMany
    {
        return $this->hasMany(Task::class,'failed_by');
    }
}
