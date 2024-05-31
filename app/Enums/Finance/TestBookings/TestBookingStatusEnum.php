<?php

namespace App\Enums\Finance\TestBookings;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;
use ArchTech\Enums\InvokableCases;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;
use App\Traits\Enums\HasDefaultFilamentLabels;

enum TestBookingStatusEnum: string implements HasLabel, HasColor
{
    use InvokableCases;
    use Names;
    use Values;
    use Options;
    use HasDefaultFilamentLabels;

    case BOOKED = 'Booked';
    case ORDER_PLACED = 'Order placed';
    case INVOICE_GENERATED = 'Invoice generated';
    case PROCESSING = 'Processing';
    case RESULT_GENERATED = 'Result generated';
    case RESULT_APPROVED = 'Result approved';
    case RESULT_REJECTED = 'Result rejected';

    case Complete = 'Complete';

    public function getColor(): string|array|null
	{
        return match ($this) {
            self::RESULT_APPROVED => 'success',
            self::PROCESSING => 'primary',
            self::RESULT_REJECTED => 'danger',
            self::RESULT_GENERATED => 'warning',
            default => 'secondary'
        };
	}

}
