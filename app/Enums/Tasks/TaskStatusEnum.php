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
}
