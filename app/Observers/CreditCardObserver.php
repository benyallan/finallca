<?php

namespace App\Observers;

use App\Models\CreditCard;

class CreditCardObserver
{
    /**
     * Handle the CreditCard "created" event.
     */
    public function created(CreditCard $creditCard): void
    {
        $creditCard->user()->associate(auth()->user())->save();
    }

    /**
     * Handle the CreditCard "updated" event.
     */
    public function updated(CreditCard $creditCard): void
    {
        //
    }

    /**
     * Handle the CreditCard "deleted" event.
     */
    public function deleted(CreditCard $creditCard): void
    {
        //
    }

    /**
     * Handle the CreditCard "restored" event.
     */
    public function restored(CreditCard $creditCard): void
    {
        //
    }

    /**
     * Handle the CreditCard "force deleted" event.
     */
    public function forceDeleted(CreditCard $creditCard): void
    {
        //
    }
}
