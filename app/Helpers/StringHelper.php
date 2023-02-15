<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class StringHelper
{
    public static function convertArrayKeysToSnakeCase(array $values): array
    {
        $snakeCaseKeyedValues = [];

        foreach ($values as $key => $value) {
            //ensure that the digits are snake cased too
            $key = preg_replace_callback(
                '/\d/',
                function ($matches) {
                    return '_' . $matches[0];
                },
                $key
            );

            $snakeCaseKeyedValues[Str::snake($key)] = $value;
        }

        return $snakeCaseKeyedValues;
    }

    public static function convertArrayValuesToSnakeCase(array $values): array
    {
        $snakeCaseKeyedValues = [];

        foreach ($values as $key => $value) {
            //ensure that the digits are snake cased too
            $key = preg_replace_callback(
                '/\d/',
                function ($matches) {
                    return '_' . $matches[0];
                },
                $key
            );

            $snakeCaseKeyedValues[$key] = Str::snake($value);
        }

        return $snakeCaseKeyedValues;
    }

    public static function convertArrayKeysToCamelCase(array $values): array
    {
        $camelCaseKeyedValues = [];

        foreach ($values as $key => $value) {

            $camelCaseKeyedValues[Str::camel($key)] = $value;
        }

        return $camelCaseKeyedValues;
    }

    public static function convertArrayValuesToCamelCase(array $values): array
    {
        $camelCaseKeyedValues = [];

        foreach ($values as $key => $value) {

            $camelCaseKeyedValues[$key] = Str::camel($value);
        }

        return $camelCaseKeyedValues;
    }

    public static function convertUppercaseCamelArrayKeysToWords(array $values): array
    {
        $titleCaseKeyedValues = [];

        foreach ($values as $key => $value) {

            $titleCaseKeyedValues[Str::camelCaseToWords(Str::camel(Str::snake(Str::lower($key))))] = $value;
        }

        return $titleCaseKeyedValues;
    }

    public static function convertUppercaseCamelArrayValuesToWords(array $values): array
    {
        $titleCaseKeyedValues = [];

        foreach ($values as $key => $value) {

            $titleCaseKeyedValues[$key] = Str::camelCaseToWords(Str::camel(Str::snake(Str::lower($value))));
        }

        return $titleCaseKeyedValues;
    }
}
