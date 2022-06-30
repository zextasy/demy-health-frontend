<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\TestResult;
use App\Models\Finance\Invoice;
use App\Observers\UserObserver;
use App\Observers\OrderObserver;
use App\Observers\ProductObserver;
use App\Observers\InvoiceObserver;
use App\Observers\TestResultObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;

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
        // prevent lazy loading
        Model::preventLazyLoading(! app()->isProduction());
        //register model Observers TODO move elsewhere? google
        TestResult::observe(TestResultObserver::class);
        Product::observe(ProductObserver::class);
        Order::observe(OrderObserver::class);
        Invoice::observe(InvoiceObserver::class);
        User::observe(UserObserver::class);
    }
}
