<?php

namespace App\Filament\Resources\CreditCardTransactionResource\Pages;

use App\Filament\Resources\CreditCardTransactionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCreditCardTransaction extends CreateRecord
{
    protected static string $resource = CreditCardTransactionResource::class;
}
