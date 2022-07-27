<?php

namespace App\Enums\BusinessGroups;

use App\Traits\Enums\HasSelectArrayOptions;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum BusinessGroupHierarchyDirectionEnum: int
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;

    case UP = 1;
    case DOWN = 2;
}
