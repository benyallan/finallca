<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Enums\Transaction\AccountableType;
use App\Enums\Transaction\Direction;
use App\Filament\Resources\TransactionResource;
use App\Models\Account;
use App\Models\CreditCard;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Pages\Actions;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Fluent;

class ListTransactions extends ListRecords
{
    protected static string $resource = TransactionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make('createTransfer'),
            Action::make('transfer')->action(function (array $data): void {
                $accountables[] = $this->fromAccountable($data);
                $accountables[] = $this->toAccountable($data);

                foreach ($accountables as $accountable) {
                    match ($accountable['accountable_type']) {
                        AccountableType::getOptionClass(AccountableType::ACCOUNT->value) => Account::find($accountable['accountable_id'])->transactions()->create($accountable),
                        AccountableType::getOptionClass(AccountableType::CREDIT_CARD->value) => CreditCard::find($accountable['accountable_id'])->transactions()->create($accountable),
                    };
                }
            })
            ->form([
                TextInput::make('description')
                    ->required()
                    ->maxLength(255)
                    ->label(__('filament_resources.transaction.columns.description')),
                TextInput::make('transaction_amount')
                    ->required()
                    ->default('1,00')
                    ->mask(fn (Mask $mask) => $mask
                        ->patternBlocks([
                            'money' => fn (Mask $mask) => $mask
                                ->numeric()
                                ->decimalPlaces(2)
                                ->mapToDecimalSeparator(['.'])
                                ->minValue(1)
                                ->normalizeZeros()
                                ->padFractionalZeros()
                                ->thousandsSeparator('.')
                                ->decimalSeparator(','),
                        ])
                        ->pattern('R$money'),
                    )
                    ->label(__('filament_resources.transaction.columns.transaction_amount')),
                DatePicker::make('due_date')
                    ->displayFormat('d/m/Y')
                    ->label(__('filament_resources.transaction.columns.due_date')),
                DatePicker::make('completed_at')
                    ->displayFormat('d/m/Y')
                    ->label(__('filament_resources.transaction.columns.completed_at')),
                Select::make('from_type_accountable')
                    ->options(AccountableType::getOptionClasses())
                    ->reactive()
                    ->required()
                    ->label(__('filament_resources.transaction.columns.accountable_from')),
                Select::make('from_accountable')
                    ->options(function (callable $get) {
                        return match ($get('from_type_accountable')) {
                            AccountableType::getOptionClass(AccountableType::ACCOUNT->value) => Account::all()->pluck('name', 'id')->toArray(),
                            AccountableType::getOptionClass(AccountableType::CREDIT_CARD->value) => CreditCard::all()->pluck('description', 'id')->toArray(),
                            default => [],
                        };
                    })
                    ->required()
                    ->label(__('')),
                Select::make('to_type_accountable')
                    ->options(AccountableType::getOptionClasses())
                    ->reactive()
                    ->required()
                    ->label(__('filament_resources.transaction.columns.accountable_to')),
                Select::make('to_accountable')
                    ->options(function (callable $get) {
                        return match ($get('from_type_accountable')) {
                            AccountableType::getOptionClass(AccountableType::ACCOUNT->value) => Account::all()->pluck('name', 'id')->toArray(),
                            AccountableType::getOptionClass(AccountableType::CREDIT_CARD->value) => CreditCard::all()->pluck('description', 'id')->toArray(),
                            default => [],
                        };
                    })
                    ->required()
                    ->label(__('')),
            ])
            ->label(__('filament_resources.transaction.actions.transfer')),
        ];
    }

    public function fromAccountable(array $transferData): array
    {
        return [
            'accountable_id' => $transferData['from_accountable'],
            'accountable_type' => $transferData['from_type_accountable'],
            'direction' => Direction::OUT->value,
            'transaction_amount' => $transferData['transaction_amount'],
            'description' => $transferData['description'],
            'due_date' => $transferData['due_date'],
            'completed_at' => $transferData['completed_at'],
        ];
    }

    public function toAccountable(array $transferData): array
    {
        return [
            'accountable_id' => $transferData['to_accountable'],
            'accountable_type' => $transferData['to_type_accountable'],
            'direction' => Direction::IN->value,
            'transaction_amount' => $transferData['transaction_amount'],
            'description' => $transferData['description'],
            'due_date' => $transferData['due_date'],
            'completed_at' => $transferData['completed_at'],
        ];
    }
}
