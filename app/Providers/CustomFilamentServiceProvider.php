<?php

namespace App\Providers;

use Filament\Facades\Filament;
use App\Filament\Pages\Profile;
use Filament\Navigation\UserMenuItem;
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
                'Account',
                'CRM',
                'Tests',
                'Products',
                'Locations',
            ]);
        });
        Filament::registerPages([
            Profile::class
        ]);
        Filament::registerUserMenuItems([
            UserMenuItem::make()
                ->label('My Details')
                ->url("/admin/profile")
                ->icon('heroicon-o-user'),
            // ...
        ]);
    }
}
