<?php

namespace App\Enums\Finance\Payments;

use App\Traits\Enums\HasSelectArrayOptions;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum PaymentMethodEnum: int
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;

    case CARD = 1;
    case BANK_TRANSFER = 2;
    case CHEQUE = 3;
    case CREDIT = 10;
    case OTHER = 100;
}
