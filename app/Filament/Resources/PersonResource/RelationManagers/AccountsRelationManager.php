<?php

namespace App\Filament\Resources\PersonResource\RelationManagers;

use App\Enums\Account\AccountType;
use App\Models\Bank;
use Filament\Forms;
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
                Forms\Components\TextInput::make('id')
                    ->maxLength(36)
                    ->disabled()
                    ->hiddenOn('create'),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->autofocus()
                    ->label(__('filament_resources.account.columns.description')),
                Forms\Components\TextInput::make('opening_balance')
                    ->label(__('filament_resources.account.columns.opening_balance')),
                Forms\Components\Select::make('bank_id')
                    ->options(Bank::all()->pluck('name', 'id')->toArray())
                    ->required()
                    ->label(__('filament_resources.bank.bank')),
                Forms\Components\Select::make('type')
                    ->options(AccountType::toFilamentSelectOptions())
                    ->required()
                    ->label(__('filament_resources.account.columns.type')),
                Forms\Components\TextInput::make('number')
                    ->required()
                    ->label(__('filament_resources.account.columns.number')),
                Forms\Components\TextInput::make('account_limit')
                    ->label(__('filament_resources.account.columns.account_limit')),
                Forms\Components\Toggle::make('income')
                    ->label(__('filament_resources.account.columns.income')),
                Forms\Components\TextInput::make('maintenance_fee')
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
                Tables\Columns\TextColumn::make('type')
                    ->sortable()
                    ->searchable()
                    ->label(__('filament_resources.account.columns.type')),
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
