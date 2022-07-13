<?php

namespace App\Enums;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;
use ArchTech\Enums\InvokableCases;
use App\Traits\Enums\HasSelectArrayOptions;

enum AgeClassificationEnum: int
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;


    case INFANT = 1;
    case CHILD = 2;
    case TEEN = 3;
    case ADULT = 4;
    case SENIOR = 5;

    case DECEASED = 100;
    case OTHER = 200;
}
