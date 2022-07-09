<?php

namespace App\Filament\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Enums\TestBookings\LocationTypeEnum;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\RelationManagers\MorphToManyRelationManager;
use Filament\Resources\RelationManagers\BelongsToManyRelationManager;

class BaseHasManyTestBookingsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'testBookings';

    protected static ?string $recordTitleAttribute = 'reference';

    protected function canCreate(): bool
    {
        return false;
    }

    protected function canAttach(): bool
    {
        return auth()->user()->isFilamentAdmin();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('reference')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference')->sortable(),
                Tables\Columns\TextColumn::make('testType.description')->sortable(),
                Tables\Columns\TextColumn::make('due_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')->sortable(),
                Tables\Columns\BadgeColumn::make('location_type')
                    ->enum(LocationTypeEnum::optionsAsSelectArray())
                    ->sortable(),
            ])
            ->filters([
                //
            ])->defaultSort('reference', 'desc');
    }
}
