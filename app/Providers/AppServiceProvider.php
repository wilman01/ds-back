<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\Quotation;
use App\Observers\CustomerObserver;
use App\Observers\QuotationObserver;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

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

        Carbon::setLocale('es');
        setlocale(LC_TIME, "es_ES");
    }
}
