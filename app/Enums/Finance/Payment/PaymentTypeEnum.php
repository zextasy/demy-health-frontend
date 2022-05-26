<?php

namespace App\Enums\Finance\Payment;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;
use ArchTech\Enums\InvokableCases;
use App\Traits\Enums\HasSelectArrayOptions;

enum PaymentTypeEnum: int
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;


    case CARD = 1;
    case BANK_TRANSFER = 2;
    case CHEQUE = 3;
    case OTHER = 10;
    case CREDIT = 100;
}
