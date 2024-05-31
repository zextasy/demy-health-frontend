<?php

namespace App\Enums\Communication;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;
use ArchTech\Enums\InvokableCases;
use Filament\Support\Contracts\HasLabel;
use App\Traits\Enums\HasDefaultFilamentLabels;

enum CommunicationStatusEnum: int implements HasLabel
{
    use InvokableCases;
    use Names;
    use Values;
    use Options;
    use HasDefaultFilamentLabels;

    case PENDING = 1;

    case SUCCESSFUL = 10;

    case CANCELLED = 20;

    case FAILED = 30;

    case PERMANENT_FAILURE = 39;

}
