<?php

namespace App\Enums\Consultations;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;
use ArchTech\Enums\InvokableCases;
use Filament\Support\Contracts\HasLabel;
use App\Traits\Enums\HasDefaultFilamentLabels;

enum ConsultationChannelEnum: int implements HasLabel
{
    use InvokableCases;
    use Names;
    use Values;
    use Options;
    use HasDefaultFilamentLabels;

    case NONE = 1;

    case ZOOM = 10;
}
