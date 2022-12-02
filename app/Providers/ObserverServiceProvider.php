<?php

namespace App\Providers;

use App\Models\Task;
use App\Models\User;
use App\Models\Order;
use App\Models\Patient;
use App\Models\Product;
use App\Models\TestResult;
use App\Models\BusinessGroup;
use App\Models\Finance\Price;
use App\Models\Finance\Invoice;
use App\Observers\TaskObserver;
use App\Observers\UserObserver;
use App\Observers\OrderObserver;
use App\Observers\PriceObserver;
use App\Observers\InvoiceObserver;
use App\Observers\PatientObserver;
use App\Observers\ProductObserver;
use App\Observers\TestResultObserver;
use Illuminate\Support\ServiceProvider;
use App\Observers\BusinessGroupObserver;
use App\Models\Finance\PaystackTransaction;
use App\Observers\PaystackTransactionObserver;

class ObserverServiceProvider extends ServiceProvider
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
        BusinessGroup::observe(BusinessGroupObserver::class);
        Invoice::observe(InvoiceObserver::class);
        Order::observe(OrderObserver::class);
        Patient::observe(PatientObserver::class);
        PaystackTransaction::observe(PaystackTransactionObserver::class);
        Price::observe(PriceObserver::class);
        Product::observe(ProductObserver::class);
        Task::observe(TaskObserver::class);
        TestResult::observe(TestResultObserver::class);
        User::observe(UserObserver::class);
    }
}
