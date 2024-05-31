<?php

namespace App\Enums\Finance\Discounts;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;
use ArchTech\Enums\InvokableCases;
use App\Models\Finance\FullDiscount;
use App\Models\Finance\FixedValueDiscount;
use App\Models\Finance\PercentageOffDiscount;
use App\Traits\Enums\HasDefaultFilamentLabels;
use App\Exceptions\UnexpectedMatchValueException;

enum DiscountTypeEnum: string
{
    use InvokableCases;
    use Names;
    use Values;
    use Options;
    use HasDefaultFilamentLabels;

    case FIXED_VALUE = 'fixed';
    case PERCENTAGE_OFF = 'percent';
    case FULL = 'full';

    /**
     * @throws UnexpectedMatchValueException
     */
    public function getClass(): string
    {
        return match ($this->name) {
            DiscountTypeEnum::FIXED_VALUE->name => FixedValueDiscount::class,
            DiscountTypeEnum::PERCENTAGE_OFF->name => PercentageOffDiscount::class,
            DiscountTypeEnum::FULL->name => FullDiscount::class,
            default => throw new UnexpectedMatchValueException,
        };
    }
}
