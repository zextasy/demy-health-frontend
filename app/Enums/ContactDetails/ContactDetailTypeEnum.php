<?php

namespace App\Enums\ContactDetails;

use App\Traits\Enums\HasSelectArrayOptions;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Options;
use ArchTech\Enums\Values;

enum ContactDetailTypeEnum: int
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;

    case PHONE = 1;
    case EMAIL = 2;
}
