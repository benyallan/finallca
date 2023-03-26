<?php

namespace App\Filament\Resources\AccountTransactionResource\Pages;

use App\Filament\Resources\AccountTransactionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAccountTransaction extends ViewRecord
{
    protected static string $resource = AccountTransactionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
