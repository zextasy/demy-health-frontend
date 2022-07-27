<?php

namespace App\Helpers;

class FilamentHelper
{
    public static function getResourceURL(string $resourcePath): string
    {
        $filamentPath = config('filament.path');

        return url("{$filamentPath}/{$resourcePath}");
    }
}
