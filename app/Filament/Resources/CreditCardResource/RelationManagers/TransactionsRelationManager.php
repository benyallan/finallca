<?php

namespace App\Filament\Resources\CreditCardResource\RelationManagers;

use App\Enums\Transaction\Direction;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class TransactionsRelationManager extends RelationManager
{
    protected static string $relationship = 'transactions';

    protected static ?string $recordTitleAttribute = 'transactions';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->label(__('filament_resources.transaction.columns.description')),
                Forms\Components\TextInput::make('transaction_amount')
                    ->required()
                    ->notIn([0])
                    ->mask(fn (Mask $mask) => $mask
                        ->patternBlocks([
                            'money' => fn (Mask $mask) => $mask
                                ->numeric()
                                ->decimalPlaces(2)
                                ->mapToDecimalSeparator(['.'])
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
                    ->options(Direction::toFilamentSelectOptions())
                    ->default(Direction::IN)
                    ->required()
                    ->disablePlaceholderSelection()
                    ->label(__('filament_resources.transaction.columns.direction.direction')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('transaction_amount')
                    ->sortable()
                    ->color(fn (Transaction $record): string => $record->direction === Direction::IN ? 'success' : 'danger')
                    ->money('BRL')
                    ->searchable()
                    ->label(__('filament_resources.transaction.columns.transaction_amount')),
                Tables\Columns\TextColumn::make('description')
                    ->sortable()
                    ->searchable()
                    ->label(__('filament_resources.transaction.columns.description')),
                Tables\Columns\TextColumn::make('date')
                    ->sortable()
                    ->date('d/m/Y')
                    ->searchable()
                    ->label(__('filament_resources.transaction.columns.date')),
                Tables\Columns\ToggleColumn::make('done')
                    ->sortable()
                    ->label(__('filament_resources.transaction.columns.done')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getModelLabel(): string
    {
        return __('filament_resources.transaction.transaction');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament_resources.transaction.transactions');
    }
}
