<?php

namespace App\Enums\Orders;

use App\Models\Finance\FullDiscount;
use App\Models\Finance\FixedValueDiscount;
use App\Models\Finance\PercentageOffDiscount;
use App\Traits\Enums\HasSelectArrayOptions;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;
use App\Exceptions\UnexpectedMatchValueException;

enum OrderStatusEnum: string
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;

    case PLACED = 'Ordered';
    case INVOICE_GENERATED = 'Invoiced';

    case COMPLETED = 'Completed';
}
