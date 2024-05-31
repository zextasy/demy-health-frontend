<?php

namespace App\Enums\Finance\Payments;

use App\Models\Finance\FullDiscount;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;
use App\Models\Finance\FixedValueDiscount;
use App\Models\Finance\PercentageOffDiscount;
use App\Traits\Enums\HasSelectArrayOptions;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;
use App\Traits\Enums\HasDefaultFilamentLabels;
use App\Exceptions\UnexpectedMatchValueException;

enum PaymentStatusEnum: string implements HasLabel, HasColor
{
    use InvokableCases;
    use Names;
    use Values;
    use Options;
    use HasDefaultFilamentLabels;

    case RECEIVED = 'Received';
    case USED = 'Used';

    case SETTLED = 'Settled';

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::USED => 'primary',
            self::SETTLED => 'success',
            default => 'secondary',
        };
    }
}
