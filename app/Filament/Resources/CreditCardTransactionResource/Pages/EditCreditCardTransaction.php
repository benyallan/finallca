<?php

namespace App\Filament\Resources\CreditCardTransactionResource\Pages;

use App\Filament\Resources\CreditCardTransactionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCreditCardTransaction extends EditRecord
{
    protected static string $resource = CreditCardTransactionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
