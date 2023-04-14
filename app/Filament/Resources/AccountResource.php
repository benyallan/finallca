<?php

namespace App\Filament\Resources;

use App\Enums\Account\AccountType;
use App\Filament\Resources\AccountResource\Pages;
use App\Filament\Resources\AccountResource\RelationManagers\TransactionsRelationManager;
use App\Models\Account;
use App\Models\Bank;
use App\Models\Person;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AccountResource extends Resource
{
    protected static ?string $model = Account::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('bank_id')
                    ->options(Bank::all()->pluck('name', 'id')->toArray())
                    ->required()
                    ->label(__('filament_resources.bank.bank')),
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
                    ->default('0,00')
                    ->mask(fn (Mask $mask) => $mask
                        ->patternBlocks([
                            'money' => fn (Mask $mask) => $mask
                                ->numeric()
                                ->decimalPlaces(2)
                                ->mapToDecimalSeparator(['.'])
                                ->minValue(0)
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
                    ->default('0,00')
                    ->mask(fn (Mask $mask) => $mask
                        ->patternBlocks([
                            'money' => fn (Mask $mask) => $mask
                                ->numeric()
                                ->decimalPlaces(2)
                                ->mapToDecimalSeparator(['.'])
                                ->minValue(0)
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
                    ->default('0,00')
                    ->mask(fn (Mask $mask) => $mask
                        ->patternBlocks([
                            'money' => fn (Mask $mask) => $mask
                                ->numeric()
                                ->decimalPlaces(2)
                                ->mapToDecimalSeparator(['.'])
                                ->minValue(0)
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
                Tables\Columns\TextColumn::make('bank.name')
                    ->sortable()
                    ->searchable()
                    ->label(__('filament_resources.bank.bank')),
                Tables\Columns\TextColumn::make('type')
                    ->sortable()
                    ->searchable()
                    ->label(__('filament_resources.account.columns.type')),
                Tables\Columns\TextColumn::make('balance')
                    ->sortable()
                    ->searchable()
                    ->money('BRL')
                    ->label(__('filament_resources.account.columns.balance')),
                Tables\Columns\TextColumn::make('account_limit')
                    ->sortable()
                    ->searchable()
                    ->money('BRL')
                    ->label(__('filament_resources.account.columns.account_limit')),
                Tables\Columns\TextColumn::make('description')
                    ->sortable()
                    ->searchable()
                    ->label(__('filament_resources.account.columns.description')),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
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
            TransactionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAccounts::route('/'),
            'create' => Pages\CreateAccount::route('/create'),
            'view' => Pages\ViewAccount::route('/{record}'),
            'edit' => Pages\EditAccount::route('/{record}/edit'),
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
        return __('filament_resources.account.account');
    }

    public static function getPluralLabel(): string
    {
        return __('filament_resources.account.accounts');
    }
}
