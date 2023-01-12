<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Traits\Relationships\BelongsToBusinessGroup;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends BaseModel
{
    use HasFactory, BelongsToBusinessGroup;

    //region CONFIG
    protected $guarded = ['id'];
    protected $with = ['assignable', 'assignedBy', 'assignedTo'];
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at',
        'assigned_at',
        'started_at',
        'completion_confirmation_requested_at',
        'completion_confirmation_approved_at',
        'completion_confirmation_rejected_at',
        'completed_at',
        'failed_at'
    ];
    //endregion

    //region ATTRIBUTES
    public function getAssignableNameAttribute(): string
    {
        return $this->assignable->getAssignableName();
    }
    //endregion

    //region HELPERS

    //endregion

    //region SCOPES

    //endregion

    //region RELATIONSHIPS
    public function assignable(): MorphTo
    {
        return $this->morphTo('assignable');
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
