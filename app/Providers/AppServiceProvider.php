<?php

namespace App\Providers;

use App\Models\BusinessGroup;
use App\Models\Finance\Invoice;
use App\Models\Finance\Price;
use App\Models\Order;
use App\Models\Patient;
use App\Models\Product;
use App\Models\TestResult;
use App\Models\User;
use App\Observers\BusinessGroupObserver;
use App\Observers\InvoiceObserver;
use App\Observers\OrderObserver;
use App\Observers\PatientObserver;
use App\Observers\PriceObserver;
use App\Observers\ProductObserver;
use App\Observers\TestResultObserver;
use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Model;
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
        // prevent lazy loading
        Model::preventLazyLoading(! app()->isProduction());
        //register model Observers TODO move elsewhere? google
        BusinessGroup::observe(BusinessGroupObserver::class);
        Invoice::observe(InvoiceObserver::class);
        Order::observe(OrderObserver::class);
        Patient::observe(PatientObserver::class);
        Price::observe(PriceObserver::class);
        Product::observe(ProductObserver::class);
        User::observe(UserObserver::class);
        TestResult::observe(TestResultObserver::class);
    }
}
