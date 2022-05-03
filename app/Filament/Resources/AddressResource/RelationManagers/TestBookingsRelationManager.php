<?php

namespace App\Filament\Resources\AddressResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use App\Enums\TestBooking\StatusEnum;
use App\Enums\TestBooking\LocationTypeEnum;
use Filament\Resources\RelationManagers\MorphToManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class TestBookingsRelationManager extends MorphToManyRelationManager
{
    protected static string $relationship = 'TestBookings';

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
                Tables\Columns\BadgeColumn::make('status')
                    ->enum(StatusEnum::optionsAsSelectArray()),
                Tables\Columns\BadgeColumn::make('location_type')
                    ->enum(LocationTypeEnum::optionsAsSelectArray()),
            ])
            ->filters([
                //
            ]);
    }
}
