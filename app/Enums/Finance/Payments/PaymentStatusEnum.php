<?php

namespace App\Enums\Finance\Payments;

use App\Models\Finance\FullDiscount;
use App\Models\Finance\FixedValueDiscount;
use App\Models\Finance\PercentageOffDiscount;
use App\Traits\Enums\HasSelectArrayOptions;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;
use App\Exceptions\UnexpectedMatchValueException;

enum PaymentStatusEnum: string
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;

    case RECEIVED = 'Received';
    case USED = 'Used';

    case SETTLED = 'Settled';

    public static function getDisplayColor(string $value):string
    {
        return match ($value) {
            self::USED->value => 'primary',
            self::SETTLED->value => 'success',
            default => 'secondary',
        };
    }
}
