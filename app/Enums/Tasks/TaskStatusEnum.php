<?php

namespace App\Enums\Tasks;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;
use App\Traits\Enums\HasDefaultFilamentLabels;

enum TaskStatusEnum: string implements HasLabel, HasColor
{
    use HasDefaultFilamentLabels;
    case PENDING = 'pending';
    case ONGOING = 'ongoing';
    case UNDER_REVIEW = 'under review';
    case COMPLETE = 'complete';
    case FAILED = 'failed';
    case UNKNOWN = 'unknown';


    public function getColor(): string|array|null
    {
        return match ($this) {
            self::COMPLETE => 'success',
            self::ONGOING => 'primary',
            self::PENDING => 'secondary',
            self::FAILED, self::UNKNOWN => 'danger',
            self::UNDER_REVIEW => 'warning',
        };
    }

}
