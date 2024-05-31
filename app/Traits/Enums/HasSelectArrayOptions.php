<?php

namespace App\Traits\Enums;

use App\Helpers\StringHelper;

trait HasSelectArrayOptions
{
    //TODO check usage and delete?
    /** Get an associative array of [case name => case value]. */
    public static function optionsAsSelectArray(): array
    {
        $cases = static::cases();

        $cases = isset($cases[0])// && $cases[0] instanceof enum
            ? array_column($cases, 'name', 'value')
            : array_column($cases, 'name');

        return StringHelper::convertUppercaseCamelArrayValuesToWords($cases);
    }
}
