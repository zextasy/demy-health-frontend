<?php

namespace App\Enums;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;
use ArchTech\Enums\InvokableCases;
use Filament\Support\Contracts\HasLabel;
use App\Traits\Enums\HasDefaultFilamentLabels;

enum PatientAcquisitionTypeEnum: int implements HasLabel
{
    use InvokableCases, Names, Values, Options, HasDefaultFilamentLabels;

    case WALK_IN = 1;
    case TEST_BOOKING = 2;

    case OTHER = 200;
}
