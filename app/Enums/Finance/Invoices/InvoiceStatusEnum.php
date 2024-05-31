<?php

namespace App\Enums\Finance\Invoices;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;
use ArchTech\Enums\InvokableCases;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;
use App\Traits\Enums\HasDefaultFilamentLabels;

enum InvoiceStatusEnum: string implements HasLabel, HasColor
{
    use InvokableCases;
    use Names;
    use Values;
    use Options;
    use HasDefaultFilamentLabels;
    case GENERATED = 'Invoiced';
    case PAYMENT_RECEIVED = 'Payment received';

    case SETTLED = 'Settled';

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::PAYMENT_RECEIVED => 'primary',
            self::SETTLED => 'success',
            default => 'secondary',
        };
    }
}
