<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use App\Traits\Enums\HasSelectArrayOptions;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;
use App\Traits\Enums\HasDefaultFilamentLabels;

enum WeekDayEnum: int implements HasLabel
{
    use InvokableCases;
    use Names;
    use Values;
    use Options;
    use HasSelectArrayOptions;
    use HasDefaultFilamentLabels;

    case SUNDAY = 1;
    case MONDAY = 2;
    case TUESDAY = 3;
    case WEDNESDAY = 4;
    case THURSDAY = 5;
    case FRIDAY = 6;
    case SATURDAY = 7;

}
