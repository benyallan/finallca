<?php

namespace App\Filament\Resources\BankResource\RelationManagers;

use App\Enums\Account\AccountType;
use App\Models\Person;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class AccountsRelationManager extends RelationManager
{
    protected static string $relationship = 'accounts';

    protected static ?string $recordTitleAttribute = 'accounts';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('type')
                    ->options(AccountType::toFilamentSelectOptions())
                    ->required()
                    ->label(__('filament_resources.account.columns.type')),
                TextInput::make('id')
                    ->maxLength(36)
                    ->disabled()
                    ->hiddenOn('create'),
                TextInput::make('opening_balance')
                    ->visibleOn('create')
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
                    ->label(__('filament_resources.account.columns.opening_balance')),
                TextInput::make('balance')
                    ->hiddenOn('create')
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
                    ->disabled()
                    ->label(__('filament_resources.account.columns.balance')),
                Select::make('person_id')
                    ->options(Person::all()->pluck('name', 'id')->toArray())
                    ->required()
                    ->label(__('filament_resources.person.person')),
                TextInput::make('account_limit')
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
                    ->label(__('filament_resources.account.columns.account_limit')),
                TextInput::make('description')
                    ->label(__('filament_resources.account.columns.description')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->sortable()
                    ->searchable()
                    ->label(__('filament_resources.account.columns.type')),
                Tables\Columns\TextColumn::make('balance')
                    ->sortable()
                    ->searchable()
                    ->money('BRL', true)
                    ->label(__('filament_resources.account.columns.balance')),
                Tables\Columns\TextColumn::make('account_limit')
                    ->sortable()
                    ->searchable()
                    ->money('BRL', true)
                    ->label(__('filament_resources.account.columns.account_limit')),
                Tables\Columns\TextColumn::make('description')
                    ->sortable()
                    ->searchable()
                    ->label(__('filament_resources.account.columns.description')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getModelLabel(): string
    {
        return __('filament_resources.account.account');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament_resources.account.accounts');
    }
}
