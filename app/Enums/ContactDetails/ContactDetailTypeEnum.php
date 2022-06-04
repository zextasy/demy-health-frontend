<?php

namespace App\Enums\ContactDetails;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;
use ArchTech\Enums\InvokableCases;
use App\Traits\Enums\HasSelectArrayOptions;

enum ContactDetailTypeEnum: int
{
    use InvokableCases, Names, Values, Options, HasSelectArrayOptions;


    case PHONE = 1;
    case EMAIL = 2;
}
