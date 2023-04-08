<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CreditCardResource\Pages;
use App\Filament\Resources\CreditCardResource\RelationManagers;
use App\Filament\Resources\CreditCardResource\RelationManagers\TransactionsRelationManager;
use App\Models\CreditCard;
use App\Models\Person;
use Filament\Forms;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CreditCardResource extends Resource
{
    protected static ?string $model = CreditCard::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->maxLength(36)
                    ->disabled()
                    ->hiddenOn('create'),
                Forms\Components\Select::make('person_id')
                    ->options(Person::all()->pluck('name', 'id')->toArray())
                    ->required()
                    ->label(__('filament_resources.person.person')),
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
                    ->mask(fn (Mask $mask) => $mask
                        ->patternBlocks([
                            'day' => fn (Mask $mask) => $mask
                                ->numeric()
                                ->integer()
                                ->minValue(1)
                                ->maxValue(28)
                                ->normalizeZeros()
                                ->thousandsSeparator('.')
                        ])
                        ->pattern('day'),
                    )
                    ->label(__('filament_resources.credit_card.columns.closing_day')),
                Forms\Components\TextInput::make('due_day')
                    ->required()
                    ->mask(fn (Mask $mask) => $mask
                        ->patternBlocks([
                            'day' => fn (Mask $mask) => $mask
                                ->numeric()
                                ->integer()
                                ->minValue(1)
                                ->maxValue(28)
                                ->normalizeZeros()
                                ->thousandsSeparator('.')
                        ])
                        ->pattern('day'),
                    )
                    ->label(__('filament_resources.credit_card.columns.due_day')),
                Forms\Components\TextInput::make('credit_card_limit')
                    ->required()
                    ->mask(fn (Mask $mask) => $mask
                        ->patternBlocks([
                            'money' => fn (Mask $mask) => $mask
                                ->numeric()
                                ->decimalPlaces(2)
                                ->mapToDecimalSeparator(['.'])
                                ->minValue(1)
                                ->normalizeZeros()
                                ->padFractionalZeros()
                                ->thousandsSeparator('.')
                                ->decimalSeparator(','),
                        ])
                        ->pattern('R$money'),
                    )
                    ->maxLength(50)
                    ->label(__('filament_resources.credit_card.columns.credit_card_limit')),
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
                Tables\Columns\TextColumn::make('person.name')
                    ->sortable()
                    ->searchable()
                    ->label(__('filament_resources.person.columns.name')),
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
                Tables\Columns\TextColumn::make('credit_card_limit')
                    ->money('brl')
                    ->sortable()
                    ->searchable()
                    ->label(__('filament_resources.credit_card.columns.credit_card_limit')),
                Tables\Columns\ToggleColumn::make('direct_debit')
                    ->sortable()
                    ->searchable()
                    ->disabled()
                    ->label(__('filament_resources.credit_card.columns.direct_debit')),
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
            'index' => Pages\ListCreditCards::route('/'),
            'create' => Pages\CreateCreditCard::route('/create'),
            'view' => Pages\ViewCreditCard::route('/{record}'),
            'edit' => Pages\EditCreditCard::route('/{record}/edit'),
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

    public static function getModelLabel(): string
    {
        return __('filament_resources.credit_card.credit_card');
    }

    public static function getPluralModelLabel(): string
    {
        return __('filament_resources.credit_card.credit_cards');
    }
}
