<?php

namespace App\Enums\Finance\Payments;

use App\Traits\Enums\HasSelectArrayOptions;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;
use App\Traits\Enums\HasDefaultFilamentLabels;

enum PaymentMethodEnum: int
{
    use InvokableCases;
    use Names;
    use Values;
    use Options;
    use HasDefaultFilamentLabels;

    case CASH = 1;
    case BANK_TRANSFER = 2;
    case CHEQUE = 3;
    case CARD = 4;
    case CREDIT = 10;
    case PAYSTACK = 20;
    case OTHER = 100;

    public function isHandledInternally(): bool
    {
        return $this == PaymentMethodEnum::CHEQUE
            || $this == PaymentMethodEnum::CREDIT
            || $this == PaymentMethodEnum::BANK_TRANSFER
            || $this == PaymentMethodEnum::CASH
            || $this == PaymentMethodEnum::OTHER;
    }

    public function isHandledExternally(): bool
    {
        return $this == PaymentMethodEnum::PAYSTACK
            || $this == PaymentMethodEnum::CARD;
    }
}
