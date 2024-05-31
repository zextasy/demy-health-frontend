<?php

namespace App\Enums;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;
use ArchTech\Enums\Options;
use ArchTech\Enums\InvokableCases;
use Filament\Support\Contracts\HasLabel;
use App\Traits\Enums\HasDefaultFilamentLabels;

enum AgeClassificationEnum: int implements HasLabel
{
    use InvokableCases;
    use Names;
    use Values;
    use Options;
    use HasDefaultFilamentLabels;

    case INFANT = 1;
    case TODDLER = 3;
    case CHILD = 12;
    case TEEN = 20;
    case ADULT = 61;
    case SENIOR = 150;

    case DECEASED = 200;
    case OTHER = 201;
    case UNKNOWN = 202;

    public static function getClassificationFromAge(int $age): AgeClassificationEnum
    {
        if ($age < AgeClassificationEnum::INFANT->value) {
            return AgeClassificationEnum::INFANT;
        } elseif ($age < AgeClassificationEnum::TODDLER->value) {
            return AgeClassificationEnum::TODDLER;
        } elseif ($age < AgeClassificationEnum::CHILD->value) {
            return AgeClassificationEnum::CHILD;
        } elseif ($age < AgeClassificationEnum::TEEN->value) {
            return AgeClassificationEnum::TEEN;
        } elseif ($age < AgeClassificationEnum::ADULT->value) {
            return AgeClassificationEnum::ADULT;
        } else {
            return AgeClassificationEnum::SENIOR;
        }
    }
}
