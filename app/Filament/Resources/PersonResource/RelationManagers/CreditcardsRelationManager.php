<?php

namespace App\Filament\Resources\PersonResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class CreditcardsRelationManager extends RelationManager
{
    protected static string $relationship = 'creditcards';

    protected static ?string $recordTitleAttribute = 'creditcards';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->maxLength(36)
                    ->disabled()
                    ->hiddenOn('create'),
                Forms\Components\TextInput::make('brand')
                    ->required()
                    ->maxLength(50)
                    ->label(__('filament_resources.credit_card.columns.brand')),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(50)
                    ->label(__('filament_resources.credit_card.columns.description')),
                Forms\Components\TextInput::make('closing_day')
                    ->required()
                    ->maxLength(50)
                    ->label(__('filament_resources.credit_card.columns.closing_day')),
                Forms\Components\TextInput::make('due_day')
                    ->required()
                    ->maxLength(50)
                    ->label(__('filament_resources.credit_card.columns.due_day')),
                Forms\Components\TextInput::make('limit')
                    ->required()
                    ->maxLength(50)
                    ->label(__('filament_resources.credit_card.columns.limit')),
                Forms\Components\Toggle::make('direct_debit')
                    ->required()
                    ->label(__('filament_resources.credit_card.columns.direct_debit')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->hidden(),
                Tables\Columns\TextColumn::make('brand')
                    ->sortable()
                    ->searchable()
                    ->label(__('filament_resources.credit_card.columns.brand')),
                Tables\Columns\TextColumn::make('description')
                    ->sortable()
                    ->searchable()
                    ->label(__('filament_resources.credit_card.columns.description')),
                Tables\Columns\TextColumn::make('closing_day')
                    ->sortable()
                    ->searchable()
                    ->label(__('filament_resources.credit_card.columns.closing_day')),
                Tables\Columns\TextColumn::make('due_day')
                    ->sortable()
                    ->searchable()
                    ->label(__('filament_resources.credit_card.columns.due_day')),
                Tables\Columns\TextColumn::make('limit')
                    ->sortable()
                    ->searchable()
                    ->label(__('filament_resources.credit_card.columns.limit')),
                Tables\Columns\ToggleColumn::make('direct_debit')
                    ->sortable()
                    ->searchable()
                    ->disabled()
                    ->label(__('filament_resources.credit_card.columns.direct_debit')),
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
}
