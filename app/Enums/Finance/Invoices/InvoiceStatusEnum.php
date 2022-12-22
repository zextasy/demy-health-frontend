<?php

namespace App\Enums\Finance\Invoices;

use App\Models\Finance\FullDiscount;
use App\Models\Finance\FixedValueDiscount;
use App\Models\Finance\PercentageOffDiscount;
use App\Traits\Enums\HasSelectArrayOptions;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;
use App\Exceptions\UnexpectedMatchValueException;

enum InvoiceStatusEnum: string
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;

    case GENERATED = 'Invoiced';
    case PAYMENT_RECEIVED = 'Payment recieved';

    case SETTLED = 'Settled';

    public static function getDisplayColor(string $value):string
    {
        return match ($value) {
            self::PAYMENT_RECEIVED->value => 'primary',
            self::SETTLED->value => 'success',
            default => 'secondary',
        };
    }
}
