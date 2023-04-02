<?php

namespace App\Providers;

use App\Models\Account;
use App\Models\Bank;
use App\Observers\AccountObserver;
use App\Observers\BankObserver;
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
        Account::observe(AccountObserver::class);
        Bank::observe(BankObserver::class);
    }
}
