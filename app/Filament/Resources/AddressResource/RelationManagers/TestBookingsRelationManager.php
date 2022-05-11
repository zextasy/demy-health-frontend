<?php

namespace App\Filament\Resources\AddressResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Enums\TestBooking\LocationTypeEnum;
use Filament\Resources\RelationManagers\MorphToManyRelationManager;

class TestBookingsRelationManager extends MorphToManyRelationManager
{
    protected static string $relationship = 'testBookings';

    protected static ?string $recordTitleAttribute = 'reference';

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
                Tables\Columns\TextColumn::make('reference'),
                Tables\Columns\TextColumn::make('testType.description'),
                Tables\Columns\TextColumn::make('due_date')
                    ->date(),
                Tables\Columns\BadgeColumn::make('status'),
                Tables\Columns\BadgeColumn::make('location_type')
                    ->enum(LocationTypeEnum::optionsAsSelectArray()),
            ])
            ->filters([
                //
            ]);
    }
}
