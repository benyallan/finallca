<?php

namespace App\Filament\Resources;

use App\Enums\Account\AccountType;
use App\Filament\Resources\AccountResource\Pages;
use App\Models\Account;
use Filament\Resources\Form;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
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
                    ->required()
                    ->label(__('filament_resources.account.columns.opening_balance')),
                TextInput::make('balance')
                    ->required()
                    ->label(__('filament_resources.account.columns.balance')),
                Select::make('type')
                    ->options(AccountType::toFilamentSelectOptions())
                    ->required()
                    ->label(__('filament_resources.account.columns.type')),
                TextInput::make('number')
                    ->required()
                    ->label(__('filament_resources.account.columns.number')),
                TextInput::make('limit')
                    ->required()
                    ->label(__('filament_resources.account.columns.limit')),
                Toggle::make('income')
                    ->required()
                    ->label(__('filament_resources.account.columns.income')),
                TextInput::make('maintenance_fee')
                    ->required()
                    ->label(__('filament_resources.account.columns.maintenance_fee')),
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
                    ->label(__('filament_resources.account.columns.balance')),
                Tables\Columns\TextColumn::make('type')
                    ->sortable()
                    ->searchable()
                    ->label(__('filament_resources.account.columns.type')),
                Tables\Columns\TextColumn::make('number')
                    ->sortable()
                    ->searchable()
                    ->label(__('filament_resources.account.columns.number')),
                Tables\Columns\TextColumn::make('limit')
                    ->sortable()
                    ->searchable()
                    ->label(__('filament_resources.account.columns.limit')),
                Tables\Columns\ToggleColumn::make('income')
                    ->disabled()
                    ->sortable()
                    ->searchable()
                    ->label(__('filament_resources.account.columns.income')),
                Tables\Columns\TextColumn::make('maintenance_fee')
                    ->sortable()
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
            //
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
            ]);
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
