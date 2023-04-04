<?php

namespace App\Filament\Resources\BankResource\RelationManagers;

use App\Enums\Account\AccountType;
use App\Models\Bank;
use App\Models\Person;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
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
