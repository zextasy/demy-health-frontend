<?php

namespace App\Providers;

use Filament\Facades\Filament;
use App\Filament\Admin\Pages\Profile;
use Filament\Navigation\UserMenuItem;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class CustomFilamentServiceProvider extends ServiceProvider
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
        Filament::registerRenderHook(
            'global-search.end',
            fn (): string => Blade::render("<livewire:notifications></livewire:notifications>"),
        );
    }
}
