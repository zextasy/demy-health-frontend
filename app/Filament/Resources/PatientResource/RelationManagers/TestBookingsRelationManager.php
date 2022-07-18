<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use App\Enums\TestBookings\LocationTypeEnum;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestBookingsRelationManager extends RelationManager
{
    protected static string $relationship = 'testBookings';

    protected static ?string $recordTitleAttribute = 'reference';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('reference')
                    ->maxLength(255)
                    ->helperText('Leave this blank and the system will generate one for you'),
                Forms\Components\Select::make('test_type_id')->label('Test Type')
                    ->relationship('testType', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\Fieldset::make('Schedule')->schema([
                    Forms\Components\DateTimePicker::make('due_date')
                        ->label('Scheduled For')
                        ->required(),
                    Forms\Components\TextInput::make('duration_minutes')
                        ->required(),
                ])->columns(3),
                Forms\Components\Select::make('location_type')
                    ->options(LocationTypeEnum::optionsAsSelectArray())
                    ->default(LocationTypeEnum::CENTER->value)
                    ->disabled(),
                Forms\Components\BelongsToSelect::make('testCenter')
                    ->relationship('testCenter', 'name')
                    ->placeholder(''),
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
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
            ]);
    }
}
