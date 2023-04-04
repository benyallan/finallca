<?php

namespace App\Filament\Resources;

use App\Enums\Account\AccountType;
use App\Filament\Resources\AccountResource\Pages;
use App\Filament\Resources\AccountResource\RelationManagers;
use App\Models\Account;
use App\Models\Bank;
use App\Models\Person;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
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
                TextInput::make('id')
                    ->maxLength(36)
                    ->disabled()
                    ->hiddenOn('create'),
                TextInput::make('description')
                    ->required()
                    ->autofocus()
                    ->label(__('filament_resources.account.columns.description')),
                TextInput::make('opening_balance')
                    ->visibleOn('create')
                    ->label(__('filament_resources.account.columns.opening_balance')),
                TextInput::make('balance')
                    ->hiddenOn('create')
                    ->disabled()
                    ->label(__('filament_resources.account.columns.balance')),
                Select::make('bank_id')
                    ->options(Bank::all()->pluck('name', 'id')->toArray())
                    ->required()
                    ->label(__('filament_resources.bank.bank')),
                Select::make('person_id')
                    ->options(Person::all()->pluck('name', 'id')->toArray())
                    ->required()
                    ->label(__('filament_resources.person.person')),
                Select::make('type')
                    ->options(AccountType::toFilamentSelectOptions())
                    ->required()
                    ->label(__('filament_resources.account.columns.type')),
                TextInput::make('number')
                    ->required()
                    ->label(__('filament_resources.account.columns.number')),
                TextInput::make('account_limit')
                    ->label(__('filament_resources.account.columns.account_limit')),
                    TextInput::make('maintenance_fee')
                    ->label(__('filament_resources.account.columns.maintenance_fee')),
                Toggle::make('income')
                    ->label(__('filament_resources.account.columns.income')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('description')
                    ->sortable()
                    ->searchable()
                    ->label(__('filament_resources.account.columns.description')),
                Tables\Columns\TextColumn::make('bank.name')
                    ->sortable()
                    ->searchable()
                    ->label(__('filament_resources.bank.bank')),
                Tables\Columns\TextColumn::make('balance')
                    ->sortable()
                    ->searchable()
                    ->money('brl', true)
                    ->label(__('filament_resources.account.columns.balance')),
                Tables\Columns\TextColumn::make('type')
                    ->sortable()
                    ->searchable()
                    ->label(__('filament_resources.account.columns.type')),
                Tables\Columns\TextColumn::make('number')
                    ->sortable()
                    ->searchable()
                    ->label(__('filament_resources.account.columns.number')),
                Tables\Columns\TextColumn::make('account_limit')
                    ->sortable()
                    ->searchable()
                    ->money('brl', true)
                    ->label(__('filament_resources.account.columns.account_limit')),
                Tables\Columns\ToggleColumn::make('income')
                    ->disabled()
                    ->sortable()
                    ->searchable()
                    ->label(__('filament_resources.account.columns.income')),
                Tables\Columns\TextColumn::make('maintenance_fee')
                    ->sortable()
                    ->money('brl', true)
                    ->searchable()
                    ->label(__('filament_resources.account.columns.maintenance_fee')),
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
            'transactions' => RelationManagers\TransactionsRelationManager::class,
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
