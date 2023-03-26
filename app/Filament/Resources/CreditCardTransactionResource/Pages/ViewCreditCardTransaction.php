<?php

namespace App\Filament\Resources\CreditCardTransactionResource\Pages;

use App\Filament\Resources\CreditCardTransactionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCreditCardTransaction extends ViewRecord
{
    protected static string $resource = CreditCardTransactionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
