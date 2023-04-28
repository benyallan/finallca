<?php

namespace App\Filament\Resources\CreditCardResource\Pages;

use App\Filament\Resources\CreditCardResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCreditCard extends CreateRecord
{
    protected static string $resource = CreditCardResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] ?? auth()->id();

        return $data;
    }
}
