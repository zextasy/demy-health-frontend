<?php

namespace App\Traits\Enums;

trait HasSelectArrayOptions
{
    /** Get an associative array of [case name => case value]. */
    public static function optionsAsSelectArray(): array
    {
        $cases = static::cases();

        return isset($cases[0])// && $cases[0] instanceof enum
            ? array_column($cases, 'name', 'value')
            : array_column($cases, 'value');
    }

}
