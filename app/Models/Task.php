<?php

namespace App\Models;

use App\Enums\Tasks\TaskTypeEnum;
use Spatie\Activitylog\LogOptions;
use App\Enums\Tasks\TaskActionEnum;
use App\Enums\Tasks\TaskStatusEnum;
use App\Traits\Models\CanBeStartedByUsers;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Traits\Models\CanBeReviewedByUsers;
use App\Traits\Models\CanBeAssignedByUsers;
use App\Traits\Models\CanBeAssignedToUsers;
use App\Traits\Models\CanBeCompletedByUsers;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Traits\Relationships\BelongsToBusinessGroup;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends BaseModel
{
    use HasFactory;
    use BelongsToBusinessGroup;
    use LogsActivity;
    use CanBeStartedByUsers;
    use CanBeCompletedByUsers;
    use CanBeReviewedByUsers;
    use CanBeAssignedByUsers;
    use CanBeAssignedToUsers;

    //region CONFIG
    protected $guarded = ['id'];
    protected $with = ['actionable','assignable', 'assignedBy', 'assignedTo'];
    //TODO: move assignedBY and assignedTO to appropriate traits
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at',
        'assigned_at',
        'started_at',
        'completion_confirmation_requested_at',
        'completion_confirmation_approved_at',
        'completion_confirmation_rejected_at',
        'completed_at',
        'failed_at',
        'due_at'
    ];
	protected $casts = [
		'type' => TaskTypeEnum::class,
        'action' => TaskActionEnum::class,
	];
    protected $appends = ['status','assignable_name', 'actionable_name'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
    //endregion

    //region ATTRIBUTES
    protected function getAssignableNameAttribute()
    {
        return $this->assignable->getAssignableName();
    }
    protected function getActionableNameAttribute()
    {
        return $this->actionable?->getActionableName() ?? 'N/A';
    }

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->calculateStatus(),
        );
    }
    //endregion

    //region HELPERS

	public function isGeneric(): bool
	{
		return $this->type === TaskTypeEnum::GENERIC;
	}

	public function isNotGeneric(): bool
	{
		return !$this->isGeneric();
	}

    public function canBeStarted(): bool
    {
        if ($this->hasNotBeenStarted()){
            return $this->hasNotBeenCompleted() && $this->hasNotBeenFailed();
        }
        return false;
    }
    public function canNotBeStarted(): bool
    {
        return !$this->canBeStarted();
    }

    public function canBeCompleted(): bool
    {
        if ($this->hasBeenStarted() && $this->doesNotNeedCompletionReview()){
            return $this->hasNotBeenCompleted() && $this->hasNotBeenFailed();
        }
        return false;
    }

    public function canNotBeCompleted(): bool
    {
        return !$this->canBeCompleted();
    }

    public function canBeReviewed(): bool
    {
        if ($this->hasBeenStarted() && $this->hasNotBeenCompleted() && $this->hasNotBeenFailed()){
            return $this->needsCompletionReview();
        }
        return false;
    }

    public function hasBeenFailed(): bool
    {
        return isset($this->failed_at) && isset($this->failed_by);
    }

    public function hasNotBeenFailed(): bool
    {
        return !$this->hasBeenFailed();
    }

    private function calculateStatus(): TaskStatusEnum
    {
        $status = TaskStatusEnum::UNKNOWN;
        if ($this->hasNotBeenStarted()){
            $status = TaskStatusEnum::PENDING;
        }
        if ($this->hasBeenStarted()){
            $status = TaskStatusEnum::ONGOING;
        }
        if ($this->needsCompletionReview()){
            $status = TaskStatusEnum::UNDER_REVIEW;
        }
        if ($this->hasBeenCompleted()){
            $status = TaskStatusEnum::COMPLETE;
        }
        if ($this->hasBeenFailed()){
            $status = TaskStatusEnum::FAILED;
        }
        return $status;
    }

    //endregion

    //region SCOPES

    //endregion

    //region RELATIONSHIPS
    public function assignable(): MorphTo
    {
        return $this->morphTo('assignable');
    }

    public function actionable(): MorphTo
    {
        return $this->morphTo('actionable');
    }
    //endregion

}
