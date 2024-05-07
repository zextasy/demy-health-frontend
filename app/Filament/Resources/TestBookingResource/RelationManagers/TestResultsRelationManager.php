<?php

namespace App\Filament\Resources\TestBookingResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Helpers\HelpTextMessageHelper;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class TestResultsRelationManager extends RelationManager
{
    protected static string $relationship = 'testResults';

    protected static ?string $recordTitleAttribute = 'test_booking_id';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('General Info')->schema([
                    Forms\Components\TextInput::make('reference')
                        ->maxLength(255)
                        ->helperText(HelpTextMessageHelper::DEFAULT_REFERENCE_SUFFIX),
                ])->columns(1),
                Forms\Components\Fieldset::make('Result')->schema([
                    SpatieMediaLibraryFileUpload::make('result')
                        ->image()
                        ->multiple()
                        ->collection('result')
                        ->enableReordering()
                        ->required(),
                ])->columns(1),
                Forms\Components\Fieldset::make('Customer Details')->schema([
                    Forms\Components\TextInput::make('customer_email')
                        ->email()
                        ->maxLength(255)
                        ->helperText('Leave this blank and the system will use the customer email from the booking'),
                ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('customer_email')->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Uploaded On')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ]);
    }
}
