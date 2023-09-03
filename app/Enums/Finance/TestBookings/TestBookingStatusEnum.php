<?php

namespace App\Enums\Finance\TestBookings;

use App\Enums\Tasks\TaskStatusEnum;
use App\Models\Finance\FullDiscount;
use App\Models\Finance\FixedValueDiscount;
use App\Models\Finance\PercentageOffDiscount;
use App\Traits\Enums\HasSelectArrayOptions;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;
use App\Exceptions\UnexpectedMatchValueException;

enum TestBookingStatusEnum: string
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;

    case BOOKED = 'Booked';
    case ORDER_PLACED = 'Order placed';
    case INVOICE_GENERATED = 'Invoice generated';
    case PROCESSING = 'Processing';
    case RESULT_GENERATED = 'Result generated';
    case RESULT_APPROVED = 'Result approved';
    case RESULT_REJECTED = 'Result rejected';

    case Complete = 'Complete';

	public static function getFilamentBadgeColor($value)
	{
        return match ($value) {
            TestBookingStatusEnum::RESULT_APPROVED->value => 'success',
            TestBookingStatusEnum::PROCESSING->value => 'primary',
            TestBookingStatusEnum::RESULT_REJECTED->value => 'danger',
            TestBookingStatusEnum::RESULT_GENERATED->value => 'warning',
            default => 'secondary'
        };
	}
}
