<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestBookingResource\Pages;
use App\Filament\Resources\TestBookingResource\RelationManagers;
use App\Models\TestBooking;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class TestBookingResource extends Resource
{
    protected static ?string $model = TestBooking::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('test_type_id')
                    ->required(),
                Forms\Components\TextInput::make('user_id'),
                Forms\Components\TextInput::make('test_center_id'),
                Forms\Components\TextInput::make('reference')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('customer_email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('location_type')
                    ->required(),
                Forms\Components\DatePicker::make('due_date')
                    ->required(),
                Forms\Components\TextInput::make('start_time')
                    ->required(),
                Forms\Components\TextInput::make('duration_minutes')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('test_type_id'),
                Tables\Columns\TextColumn::make('user_id'),
                Tables\Columns\TextColumn::make('test_center_id'),
                Tables\Columns\TextColumn::make('reference'),
                Tables\Columns\TextColumn::make('customer_email'),
                Tables\Columns\BooleanColumn::make('location_type'),
                Tables\Columns\TextColumn::make('due_date')
                    ->date(),
                Tables\Columns\TextColumn::make('start_time'),
                Tables\Columns\TextColumn::make('duration_minutes'),

            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestBookings::route('/'),
            'create' => Pages\CreateTestBooking::route('/create'),
            'edit' => Pages\EditTestBooking::route('/{record}/edit'),
        ];
    }
}
