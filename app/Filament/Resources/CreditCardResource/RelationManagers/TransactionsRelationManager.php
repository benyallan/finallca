<?php

namespace App\Filament\Resources\CreditCardResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionsRelationManager extends RelationManager
{
    protected static string $relationship = 'transactions';

    protected static ?string $recordTitleAttribute = 'CreditCardTransaction';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')->visibleOn(['view','edit'])->disabled(),
                Forms\Components\TextInput::make('description')
                    ->label(__('filament_resources.credit_card_transaction.columns.description'))
                    ->required(),
                Forms\Components\TextInput::make('value')
                    ->label(__('filament_resources.credit_card_transaction.columns.value'))
                    ->required(),
                Forms\Components\TextInput::make('type')
                    ->label(__('filament_resources.credit_card_transaction.columns.type'))
                    ->required(),
                Forms\Components\TextInput::make('date')
                    ->label(__('filament_resources.credit_card_transaction.columns.date'))
                    ->required(),
                Forms\Components\TextInput::make('direction')
                    ->label(__('filament_resources.credit_card_transaction.columns.direction'))
                    ->required(),
                Forms\Components\TextInput::make('status')
                    ->label(__('filament_resources.credit_card_transaction.columns.status'))
                    ->required(),
                Forms\Components\TextInput::make('created_at')
                    ->label(__('filament_resources.credit_card_transaction.columns.created_at'))
                    ->required(),
                Forms\Components\TextInput::make('updated_at')
                    ->label(__('filament_resources.credit_card_transaction.columns.updated_at'))
                    ->required(),
                Forms\Components\TextInput::make('deleted_at')
                    ->label(__('filament_resources.credit_card_transaction.columns.deleted_at'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->hidden(),
                Tables\Columns\TextColumn::make('credit_card_id')->hidden(),
                Tables\Columns\TextColumn::make('description')
                    ->label(__('filament_resources.credit_card_transaction.columns.description'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('value')
                    ->label(__('filament_resources.credit_card_transaction.columns.value'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label(__('filament_resources.credit_card_transaction.columns.type'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->label(__('filament_resources.credit_card_transaction.columns.date'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('direction')
                    ->label(__('filament_resources.credit_card_transaction.columns.direction'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('filament_resources.credit_card_transaction.columns.status'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('filament_resources.credit_card_transaction.columns.created_at'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('filament_resources.credit_card_transaction.columns.updated_at'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label(__('filament_resources.credit_card_transaction.columns.deleted_at'))
                    ->searchable(),
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
        return __('filament_resources.credit_card_transaction.credit_card_transaction');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament_resources.credit_card_transaction.credit_card_transactions');
    }
}
