<?php

declare(strict_types=1);

namespace App\Observers;

use App\Enums\Transaction\Direction;
use App\Models\Transaction;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     */
    public function created(Transaction $transaction): void
    {
        if ($transaction->direction === Direction::OUT) {
            $transaction->transaction_amount *= -1;
            $transaction->save();
        }

        if (blank($transaction->user_id)) {
            $transaction->user()->associate(auth()->user())->save();
        }
    }

    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        if ($transaction->direction === Direction::OUT && $transaction->transaction_amount > 0) {
            $transaction->transaction_amount *= -1;
            $transaction->save();
        }
    }

    /**
     * Handle the Transaction "deleted" event.
     */
    public function deleted(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     */
    public function restored(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     */
    public function forceDeleted(Transaction $transaction): void
    {
        //
    }
}
