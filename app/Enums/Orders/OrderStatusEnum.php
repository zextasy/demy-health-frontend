<?php

namespace App\Enums\Orders;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;
use ArchTech\Enums\InvokableCases;
use Filament\Support\Contracts\HasLabel;
use App\Traits\Enums\HasDefaultFilamentLabels;

enum OrderStatusEnum: string  implements HasLabel
{
    use InvokableCases;
    use Names;
    use Values;
    use Options;
    use HasDefaultFilamentLabels;

    case PLACED = 'Ordered';
    case INVOICE_GENERATED = 'Invoiced';

    case COMPLETED = 'Completed';
}
