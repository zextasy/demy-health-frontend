<?php

namespace App\Providers;

use Filament\Facades\Filament;
use App\Filament\Pages\Profile;
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
        Filament::serving(function () {
            Filament::registerNavigationGroups([
                'Dashboards',
                'Account',
                'Personal',
                'CRM',
                'Consultation',
                'Tests',
                'Finance',
                'Products',
                'Blog',
                'Marketing',
                'Locations',
            ]);
        });
        Filament::registerPages([
            Profile::class,
        ]);
        Filament::registerUserMenuItems([
            UserMenuItem::make()
                ->label('My Details')
                ->url('/admin/profile')
                ->icon('heroicon-o-user'),
            // ...
        ]);
        Filament::registerRenderHook(
            'global-search.end',
            fn (): string => Blade::render("<livewire:notifications></livewire:notifications>"),
        );
        Filament::registerTheme(
            mix('css/filament.css'),
        );
    }
}
