<?php

namespace App\Enums\Finance\Payments;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;
use ArchTech\Enums\InvokableCases;
use App\Traits\Enums\HasSelectArrayOptions;

enum PaymentMethodEnum: int
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;


    case CARD = 1;
    case BANK_TRANSFER = 2;
    case CHEQUE = 3;
    case CREDIT = 10;
    case OTHER = 100;

}
