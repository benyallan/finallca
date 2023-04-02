<?php

namespace App\Observers;

use App\Models\CreditCardTransaction;

class CreditCardTransactionObserver
{
    /**
     * Handle the CreditCardTransaction "created" event.
     */
    public function created(CreditCardTransaction $creditCardTransaction): void
    {
        $creditCardTransaction->user()->associate(auth()->user())->save();
    }

    /**
     * Handle the CreditCardTransaction "updated" event.
     */
    public function updated(CreditCardTransaction $creditCardTransaction): void
    {
        //
    }

    /**
     * Handle the CreditCardTransaction "deleted" event.
     */
    public function deleted(CreditCardTransaction $creditCardTransaction): void
    {
        //
    }

    /**
     * Handle the CreditCardTransaction "restored" event.
     */
    public function restored(CreditCardTransaction $creditCardTransaction): void
    {
        //
    }

    /**
     * Handle the CreditCardTransaction "force deleted" event.
     */
    public function forceDeleted(CreditCardTransaction $creditCardTransaction): void
    {
        //
    }
}
