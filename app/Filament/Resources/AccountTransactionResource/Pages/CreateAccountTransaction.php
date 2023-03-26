<?php

namespace App\Filament\Resources\AccountTransactionResource\Pages;

use App\Filament\Resources\AccountTransactionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAccountTransaction extends CreateRecord
{
    protected static string $resource = AccountTransactionResource::class;
}
