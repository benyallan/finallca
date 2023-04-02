<?php

namespace App\Observers;

use App\Models\AccountTransaction;

class AccountTransactionObserver
{
    /**
     * Handle the AccountTransaction "created" event.
     */
    public function created(AccountTransaction $accountTransaction): void
    {
        $accountTransaction->user()->associate(auth()->user())->save();
    }

    /**
     * Handle the AccountTransaction "updated" event.
     */
    public function updated(AccountTransaction $accountTransaction): void
    {
        //
    }

    /**
     * Handle the AccountTransaction "deleted" event.
     */
    public function deleted(AccountTransaction $accountTransaction): void
    {
        //
    }

    /**
     * Handle the AccountTransaction "restored" event.
     */
    public function restored(AccountTransaction $accountTransaction): void
    {
        //
    }

    /**
     * Handle the AccountTransaction "force deleted" event.
     */
    public function forceDeleted(AccountTransaction $accountTransaction): void
    {
        //
    }
}
