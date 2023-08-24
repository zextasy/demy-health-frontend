<?php

namespace App\Models;

use App\Enums\Tasks\TaskTypeEnum;
use Spatie\Activitylog\LogOptions;
use App\Enums\Tasks\TaskActionEnum;
use App\Enums\Tasks\TaskStatusEnum;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Traits\Relationships\BelongsToBusinessGroup;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends BaseModel
{
    use HasFactory;
    use BelongsToBusinessGroup;
    use LogsActivity;

    //region CONFIG
    protected $guarded = ['id'];
    protected $with = ['actionable','assignable', 'assignedBy', 'assignedTo'];
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
        'status' => TaskStatusEnum::class,
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

    public function wasAssignedBy(int|User $user): bool
    {
        $userId = $user instanceof User ? $user->id : $user;
        return $this->assigned_by === $userId;
    }

    public function wasAssignedTo(int|User $user): bool
    {
        $userId = $user instanceof User ? $user->id : $user;
        return $this->assigned_to === $userId;
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

    public function needsCompletionReview(): bool
    {
        return isset($this->completion_confirmation_requested_at) && isset($this->completion_confirmation_requested_by);
    }

    public function doesNotNeedCompletionReview(): bool
    {
        return !$this->needsCompletionReview();
    }
    public function hasBeenStarted(): bool
    {
        return isset($this->started_at) && isset($this->started_by);
    }

    public function hasNotBeenStarted(): bool
    {
        return !$this->hasBeenStarted();
    }
    public function hasBeenCompleted(): bool
    {
        return isset($this->completed_at) && isset($this->completed_by);
    }

    public function hasNotBeenCompleted(): bool
    {
        return !$this->hasBeenCompleted();
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
        if ($this->hasBeenFailed()){
            return TaskStatusEnum::FAILED;
        }

        if ($this->hasBeenCompleted()){
            return TaskStatusEnum::COMPLETE;
        }

        if ($this->needsCompletionReview()){
            return TaskStatusEnum::UNDER_REVIEW;
        }

        if ($this->hasBeenStarted()){
            return TaskStatusEnum::ONGOING;
        }

        if ($this->hasNotBeenStarted()){
            return TaskStatusEnum::PENDING;
        }
        return TaskStatusEnum::UNKNOWN;
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

    public function assignedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function startedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'started_by');
    }

    public function completionApprovedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'completion_approved_by');
    }

    public function completedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'completed_by');
    }
    //endregion

}
