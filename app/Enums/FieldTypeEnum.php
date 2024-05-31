<?php

namespace App\Enums;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;
use ArchTech\Enums\InvokableCases;
use Filament\Support\Contracts\HasLabel;
use App\Traits\Enums\HasSelectArrayOptions;
use App\Traits\Enums\HasDefaultFilamentLabels;

enum FieldTypeEnum: int implements HasLabel
{
    use InvokableCases;
    use Names;
    use Values;
    use Options;
    use HasSelectArrayOptions;
    use HasDefaultFilamentLabels;

    case TEXT = 1;
    case TEXTAREA = 2;
    case INTEGER = 3;
    case DECIMAL = 4;
    case CHECKBOX = 11;
    case TOGGLE = 12;
    case BOOLEAN_RADIO = 13;
    case DATE = 21;
    case DATETIME = 22;
    case SELECT = 31;
    case MULTISELECT = 32;
    case RADIO = 33;
    case CHECK_BOX_LIST = 34;
    case TAG = 41;
    case KEY_VALUE = 51;
    case COLOR = 61;
    case FILE = 101;

}
