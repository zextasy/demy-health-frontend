<?php

namespace App\Enums\Tasks;

enum TaskStatusEnum: string
{

    case PENDING = 'pending';
    case ONGOING = 'ongoing';
    case UNDER_REVIEW = 'under review';
    case COMPLETE = 'complete';
    case FAILED = 'failed';
    case UNKNOWN = 'unknown';

    public static function getFilamentBadgeColor($value)
    {
        return match ($value) {
            TaskStatusEnum::COMPLETE->value => 'success',
            TaskStatusEnum::ONGOING->value => 'primary',
            TaskStatusEnum::PENDING->value => 'secondary',
            TaskStatusEnum::FAILED->value, TaskStatusEnum::UNKNOWN->value => 'danger',
            TaskStatusEnum::UNDER_REVIEW->value => 'warning',
            default => 'none'
        };
    }
}
