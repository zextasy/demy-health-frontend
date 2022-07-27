<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Str::macro('camelCaseToWords', function (string $string) {
            $pieces = preg_split('/(?=[A-Z])/', $string);
            $word = implode(' ', $pieces);

            return ucwords($word);
        });
    }
}
