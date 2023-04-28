<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Enums\Transaction\Direction;
use App\Filament\Resources\TransactionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] ?? auth()->id();

        if ($data['direction'] === Direction::OUT) {
            $data['transaction_amount'] *= -1;
        }

        return $data;
    }
}
