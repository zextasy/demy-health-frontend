<?php

namespace App\Filament\Admin\Resources\PatientResource\RelationManagers;

use App\Helpers\HelpTextMessageHelper;
use App\Enums\TestBookings\LocationTypeEnum;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables;

class TestBookingsRelationManager extends RelationManager
{
    protected static string $relationship = 'testBookings';

    protected static ?string $recordTitleAttribute = 'reference';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('reference')
                    ->maxLength(255)
                    ->helperText(HelpTextMessageHelper::DEFAULT_REFERENCE_SUFFIX),
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
                    ->options(LocationTypeEnum::class)
                    ->default(LocationTypeEnum::CENTER->value)
                    ->disabled(),
                Forms\Components\BelongsToSelect::make('testCenter')
                    ->relationship('testCenter', 'name')
                    ->placeholder(''),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference')->sortable(),
                Tables\Columns\TextColumn::make('testType.name')->sortable(),
                Tables\Columns\TextColumn::make('due_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')->badge(),
                Tables\Columns\TextColumn::make('location_type')->badge()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
//                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
            ]);
    }
}
