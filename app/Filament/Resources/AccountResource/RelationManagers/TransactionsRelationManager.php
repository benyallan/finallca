<?php

namespace App\Filament\Resources\AccountResource\RelationManagers;

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

    protected static ?string $recordTitleAttribute = 'AccountTransaction';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->visibleOn(['view', 'edit'])
                    ->disabled(),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255)
                    ->label(__('filament_resources.account_transaction.columns.description')),
                Forms\Components\TextInput::make('value')
                    ->required()
                    ->label(__('filament_resources.account_transaction.columns.value')),
                Forms\Components\TextInput::make('type')
                    ->required()
                    ->maxLength(255)
                    ->label(__('filament_resources.account_transaction.columns.type')),
                Forms\Components\DatePicker::make('date')
                    ->required()
                    ->label(__('filament_resources.account_transaction.columns.date')),
                Forms\Components\TextInput::make('direction')
                    ->required()
                    ->maxLength(255)
                    ->label(__('filament_resources.account_transaction.columns.direction')),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255)
                    ->label(__('filament_resources.account_transaction.columns.status')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->hidden(),
                Tables\Columns\TextColumn::make('account.id')->hidden(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->sortable()
                    ->label(__('filament_resources.account_transaction.columns.description')),
                Tables\Columns\TextColumn::make('value')
                    ->searchable()
                    ->sortable()
                    ->label(__('filament_resources.account_transaction.columns.value')),
                Tables\Columns\TextColumn::make('type')
                    ->searchable()
                    ->sortable()
                    ->label(__('filament_resources.account_transaction.columns.type')),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->searchable()
                    ->sortable()
                    ->label(__('filament_resources.account_transaction.columns.date')),
                Tables\Columns\TextColumn::make('direction')
                    ->searchable()
                    ->sortable()
                    ->label(__('filament_resources.account_transaction.columns.direction')),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->sortable()
                    ->label(__('filament_resources.account_transaction.columns.status')),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->searchable()
                    ->sortable()
                    ->label(__('filament_resources.account_transaction.columns.deleted_at')),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->searchable()
                    ->sortable()
                    ->label(__('filament_resources.account_transaction.columns.created_at')),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->searchable()
                    ->sortable()
                    ->label(__('filament_resources.account_transaction.columns.updated_at')),
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
}
