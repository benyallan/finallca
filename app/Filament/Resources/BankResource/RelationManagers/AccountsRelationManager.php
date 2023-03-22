<?php

namespace App\Filament\Resources\BankResource\RelationManagers;

use App\Enums\Account\AccountType;
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
                    ->required()
                    ->label(__('filament_resources.account.columns.opening_balance')),
                Forms\Components\TextInput::make('balance')
                    ->required()
                    ->label(__('filament_resources.account.columns.balance')),
                Forms\Components\Select::make('type')
                    ->options(AccountType::toFilamentSelectOptions())
                    ->required()
                    ->label(__('filament_resources.account.columns.type')),
                Forms\Components\TextInput::make('number')
                    ->required()
                    ->label(__('filament_resources.account.columns.number')),
                Forms\Components\TextInput::make('limit')
                    ->required()
                    ->label(__('filament_resources.account.columns.limit')),
                Forms\Components\Toggle::make('income')
                    ->required()
                    ->label(__('filament_resources.account.columns.income')),
                Forms\Components\TextInput::make('maintenance_fee')
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
