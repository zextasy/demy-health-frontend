<?php

namespace App\Enums\CRM\CustomerEnquiries;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;
use ArchTech\Enums\InvokableCases;
use Filament\Support\Contracts\HasLabel;
use App\Traits\Enums\HasDefaultFilamentLabels;

enum EnquiryTypeEnum: int implements HasLabel
{
    use InvokableCases;
    use Names;
    use Values;
    use Options;
    use HasDefaultFilamentLabels;

    //TODO delete this  and use standard enquiry workflow
    case GENERAL = 1;
    case QUOTE = 2;
    case OTHER = 100;

}
