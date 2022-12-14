<?php

namespace App\Filament\RelationManagers;

use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use App\Enums\Finance\Discounts\DiscountTypeEnum;
use Filament\Resources\RelationManagers\RelationManager;

class BaseMorphManyDiscountsRelationManager extends RelationManager
{
    protected static string $relationship = 'discounts';

    protected static ?string $recordTitleAttribute = 'name';

    protected function canCreate(): bool
    {
        return auth()->user()->isFilamentBackendUser();
    }

    protected function canEdit(Model $record): bool
    {
        return true;
    }

    protected function canDelete(Model $record): bool
    {
        return auth()->user()->isFilamentAdmin();
    }

    protected function canAttach(): bool
    {
        return auth()->user()->isFilamentBackendUser();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('code')
                    ->required(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Select::make('type')
                    ->options(DiscountTypeEnum::optionsAsSelectArray())
                    ->required(),
                TextInput::make('discount_value')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code'),
                TextColumn::make('name'),
                TextColumn::make('type'),
                TextColumn::make('discount_value'),
            ])
            ->filters([
                //
            ]);
    }
}
