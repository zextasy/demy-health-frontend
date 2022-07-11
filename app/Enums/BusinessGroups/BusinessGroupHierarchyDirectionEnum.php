<?php

namespace App\Enums\BusinessGroups;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;
use ArchTech\Enums\InvokableCases;
use App\Traits\Enums\HasSelectArrayOptions;

enum BusinessGroupHierarchyDirectionEnum: int
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;


    case UP = 1;
    case DOWN = 2;
}
