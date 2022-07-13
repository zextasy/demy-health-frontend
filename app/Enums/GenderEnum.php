<?php

namespace App\Enums;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;
use ArchTech\Enums\InvokableCases;
use App\Traits\Enums\HasSelectArrayOptions;

enum GenderEnum: int
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;


    case MALE = 1;
    case FEMALE = 2;

    case OTHER = 200;
}
