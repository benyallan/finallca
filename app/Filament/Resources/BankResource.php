<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BankResource\Pages;
use App\Filament\Resources\BankResource\RelationManagers;
use App\Models\Bank;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BankResource extends Resource
{
    protected static ?string $model = Bank::class;

    protected static ?string $navigationIcon = 'heroicon-o-office-building';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->maxLength(36)
                    ->disabled()
                    ->hiddenOn('create'),
                Forms\Components\TextInput::make('number')
                    ->required()
                    ->maxLength(3)
                    ->label(__('filament_resources.bank.columns.number')),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(50)
                    ->label(__('filament_resources.bank.columns.name')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->hidden(),
                Tables\Columns\TextColumn::make('number')
                    ->searchable()
                    ->sortable()
                    ->label(__('filament_resources.bank.columns.number')),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label(__('filament_resources.bank.columns.name')),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->hidden(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->hidden(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->hidden(),
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
            RelationManagers\AccountsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBanks::route('/'),
            'create' => Pages\CreateBank::route('/create'),
            'view' => Pages\ViewBank::route('/{record}'),
            'edit' => Pages\EditBank::route('/{record}/edit'),
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
        return __('filament_resources.bank.bank');
    }

    public static function getPluralLabel(): string
    {
        return __('filament_resources.bank.banks');
    }
}
