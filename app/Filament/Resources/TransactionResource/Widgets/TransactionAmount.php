<?php

declare(strict_types=1);

namespace App\Filament\Resources\TransactionResource\Widgets;

use Akaunting\Money\Money;
use App\Filament\Resources\TransactionResource;
use Filament\Widgets\Widget;
use Illuminate\Contracts\View\View;

class TransactionAmount extends Widget
{
    protected static string $view = 'filament.resources.transaction-resource.widgets.transaction-amount';

    protected $listeners = [
        'updateWidget' => 'updateAmount',
    ];

    public $amount;

    public function updateAmount($value)
    {
        $this->amount = Money::BRL($value)->format();
    }

    public function render(): View
    {
        if (is_null($this->amount)) {
            $money = Money::BRL(TransactionResource::getEloquentQuery()
                ->where('deleted_at', null)
                ->sum('transaction_amount'));
            $this->amount = $money->format();
        }

        return view(static::$view, $this->getViewData());
    }
}
