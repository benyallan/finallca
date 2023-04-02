<?php

namespace App\Providers;

use App\Models\Account;
use App\Models\AccountTransaction;
use App\Models\Bank;
use App\Models\CreditCard;
use App\Models\CreditCardTransaction;
use App\Models\Person;
use App\Observers\AccountObserver;
use App\Observers\AccountTransactionObserver;
use App\Observers\BankObserver;
use App\Observers\CreditCardObserver;
use App\Observers\CreditCardTransactionObserver;
use App\Observers\PersonObserver;
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
        Person::observe(PersonObserver::class);
        AccountTransaction::observe(AccountTransactionObserver::class);
        CreditCard::observe(CreditCardObserver::class);
        CreditCardTransaction::observe(CreditCardTransactionObserver::class);
    }
}
