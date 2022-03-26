<?php

namespace App\Providers;

use App\Models\TestBooking;
use App\Observers\TestBookingObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        TestBooking::observe(TestBookingObserver::class);
    }
}
