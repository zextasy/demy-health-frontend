<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use App\Traits\Enums\HasSelectArrayOptions;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;
use App\Traits\Enums\HasDefaultFilamentLabels;

enum PatientDataDetailEnum: int implements HasLabel
{
    use InvokableCases;
    use Names;
    use Values;
    use Options;
    use HasSelectArrayOptions;
    use HasDefaultFilamentLabels;

    case REGULAR = 1;
    case DETAILED = 2;

    case NONE = 200;
}
