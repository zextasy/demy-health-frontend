<?php

namespace App\Enums\BusinessGroups;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;
use ArchTech\Enums\InvokableCases;
use Filament\Support\Contracts\HasLabel;
use App\Traits\Enums\HasDefaultFilamentLabels;

enum BusinessGroupHierarchyDirectionEnum: int  implements HasLabel
{
    use InvokableCases;
    use Names;
    use Values;
    use Options;
    use HasDefaultFilamentLabels;

    case UP = 1;
    case DOWN = 2;
}
