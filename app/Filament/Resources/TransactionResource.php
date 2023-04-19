<?php

namespace App\Filament\Resources;

use App\Enums\Transaction\Direction;
use App\Filament\Resources\TransactionResource\Pages;
use App\Models\Account;
use App\Models\CreditCard;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-right';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255)
                    ->label(__('filament_resources.transaction.columns.description')),
                Forms\Components\TextInput::make('transaction_amount')
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
                Forms\Components\DatePicker::make('date')
                    ->displayFormat('d/m/Y')
                    ->label(__('filament_resources.transaction.columns.date')),
                Forms\Components\Toggle::make('done')
                    ->label(__('filament_resources.transaction.columns.done')),
                Forms\Components\Select::make('direction')
                    ->required()
                    ->options(Direction::toFilamentSelectOptions())
                    ->default(Direction::IN)
                    ->disablePlaceholderSelection()
                    ->label(__('filament_resources.transaction.columns.direction.direction')),
                Forms\Components\MorphToSelect::make('accountable')
                    ->types([
                        MorphToSelect\Type::make(Account::class)
                            ->label(__('filament_resources.account.account'))
                            ->getOptionLabelFromRecordUsing(fn (Account $record): string => "{$record->name}")
                            ->titleColumnName('description'),
                        MorphToSelect\Type::make(CreditCard::class)
                            ->label(__('filament_resources.credit_card.credit_card'))
                            ->titleColumnName('description'),
                    ])
                    ->required()
                    ->label(__('filament_resources.transaction.columns.accountable')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('transaction_amount')
                    ->sortable()
                    ->color(fn (Transaction $record): string => $record->direction === Direction::IN ? 'success' : 'danger')
                    ->searchable()
                    ->money('BRL')
                    ->label(__('filament_resources.transaction.columns.transaction_amount')),
                Tables\Columns\TextColumn::make('description')
                    ->sortable()
                    ->searchable()
                    ->label(__('filament_resources.transaction.columns.description')),
                Tables\Columns\TextColumn::make('date')
                    ->date(format: 'd/m/Y')
                    ->sortable()
                    ->searchable()
                    ->label(__('filament_resources.transaction.columns.date')),
                Tables\Columns\ToggleColumn::make('done')
                    ->label(__('filament_resources.transaction.columns.done')),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\SelectFilter::make('direction')
                    ->options(Direction::toFilamentSelectOptions())
                    ->label(__('filament_resources.transaction.columns.direction.direction')),
                Tables\Filters\Filter::make('due_date')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('Data de vencimento de'),
                        Forms\Components\DatePicker::make('until')
                            ->label('Até'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('due_date', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('due_date', '<=', $date),
                            );
                    }),
                Tables\Filters\Filter::make('completed_at')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('Data do pagamento ou recebimento de'),
                        Forms\Components\DatePicker::make('until')
                            ->label('Até'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('completed_at', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('completed_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'view' => Pages\ViewTransaction::route('/{record}'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ])
            ->whereBelongsTo(auth()->user());
    }

    public static function getLabel(): string
    {
        return __('filament_resources.transaction.transaction');
    }

    public static function getPluralLabel(): ?string
    {
        return __('filament_resources.transaction.transactions');
    }
}
