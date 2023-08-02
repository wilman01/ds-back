<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\Quotation;
use App\Observers\CustomerObserver;
use App\Observers\QuotationObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Customer::observe(CustomerObserver::class);
        Quotation::observe(QuotationObserver::class);
    }
}
