<?php

namespace App\Enums\ContactDetails;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;
use ArchTech\Enums\InvokableCases;
use App\Traits\Enums\HasDefaultFilamentLabels;

enum ContactDetailTypeEnum: int
{
    use InvokableCases;
    use Names;
    use Values;
    use Options;
    use HasDefaultFilamentLabels;

    case PHONE = 1;
    case EMAIL = 2;
}
