<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Enums\Transaction\AccountableType;
use App\Enums\Transaction\Direction;
use App\Filament\Resources\TransactionResource;
use App\Filament\Resources\TransactionResource\Widgets\TransactionAmount;
use App\Models\Account;
use App\Models\CreditCard;
use App\Models\Transaction;
use App\Models\Transfer;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Forms\Components\Toggle;
use Filament\Pages\Actions;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListTransactions extends ListRecords
{
    protected static string $resource = TransactionResource::class;

    protected function getActions(): array
    {
        $this->emit('updateWidget', $this->getFilteredTableQuery()->sum('transaction_amount'));

        return [
            Actions\CreateAction::make('createTransfer'),
            Action::make('transfer')->action(function (array $data): void {
                $transactionFrom = Transaction::create($this->fromAccountable($data));
                $transactionTo = Transaction::create($this->toAccountable($data));
                $transfer = new Transfer();

                match ($transactionFrom->accountable_type) {
                    AccountableType::getOptionClass(AccountableType::ACCOUNT->value) => Account::find($transactionFrom->accountable_id)
                            ->transactions()
                            ->save($transactionFrom),
                    AccountableType::getOptionClass(AccountableType::CREDIT_CARD->value) => CreditCard::find($transactionFrom->accountable_id)
                            ->transactions()
                            ->save($transactionFrom),
                };
                $transfer->sender()->save($transactionFrom);

                match ($transactionTo->accountable_type) {
                    AccountableType::getOptionClass(AccountableType::ACCOUNT->value) => Account::find($transactionTo->accountable_id)
                            ->transactions()
                            ->save($transactionTo),
                    AccountableType::getOptionClass(AccountableType::CREDIT_CARD->value) => CreditCard::find($transactionTo->accountable_id)
                            ->transactions()
                            ->save($transactionTo),
                };
                $transfer->destination()->save($transactionTo);
            })
            ->form([
                TextInput::make('description')
                    ->required()
                    ->maxLength(255)
                    ->label(__('filament_resources.transaction.columns.description')),
                TextInput::make('transaction_amount')
                    ->required()
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
                DatePicker::make('date')
                    ->displayFormat('d/m/Y')
                    ->label(__('filament_resources.transaction.columns.date')),
                Toggle::make('done')
                    ->label(__('filament_resources.transaction.columns.done')),

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
                        return match ($get('to_type_accountable')) {
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

    protected function fromAccountable(array $transferData): array
    {
        return [
            'accountable_id' => $transferData['from_accountable'],
            'accountable_type' => $transferData['from_type_accountable'],
            'direction' => Direction::OUT->value,
            'transaction_amount' => $transferData['transaction_amount'],
            'description' => $transferData['description'],
            'date' => $transferData['date'],
            'done' => $transferData['done'],
        ];
    }

    protected function toAccountable(array $transferData): array
    {
        return [
            'accountable_id' => $transferData['to_accountable'],
            'accountable_type' => $transferData['to_type_accountable'],
            'direction' => Direction::IN->value,
            'transaction_amount' => $transferData['transaction_amount'],
            'description' => $transferData['description'],
            'date' => $transferData['date'],
            'done' => $transferData['done'],
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TransactionAmount::class,
        ];
    }

    public function updated($name, $value)
    {
        $this->emit('updateWidget', $this->getFilteredTableQuery()->sum('transaction_amount'));
    }
}
