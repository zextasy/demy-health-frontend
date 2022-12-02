<?php

namespace App\Filament\Resources;

use App\Enums\AgeClassificationEnum;
use App\Enums\GenderEnum;
use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Models\Country;
use App\Models\Patient;
use App\Models\ReferralChannel;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Consultation';

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasPermissionTo('backend');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('reference')
                    ->maxLength(255)
                    ->helperText('Reference number for the patient. Leave this blank and the system will generate one for you'),
                Fieldset::make('Name')->schema([
                    TextInput::make('first_name')
                        ->required(),
                    TextInput::make('middle_name'),
                    TextInput::make('last_name')
                        ->required(),
                ])->columns(3),
                Fieldset::make('Age')->schema([
                    DatePicker::make('date_of_birth'),
                    //                    TextInput::make('age')->label('Age (Years)')->numeric(),
                    Select::make('age_classification')->options(AgeClassificationEnum::optionsAsSelectArray()),
                ])->columns(3),
                Fieldset::make('Data')->schema([
                    Select::make('gender')->options(GenderEnum::optionsAsSelectArray()),
                    TextInput::make('height')->numeric(),
                    TextInput::make('weight')->numeric(),
                ])->columns(3),
                Fieldset::make('Nationality')->schema([
                    Select::make('country_id')
                        ->options(Country::all()->toSelectArray())
                        ->searchable()
                        ->label('Nationality'),
                    TextInput::make('passport_number')
                        ->maxLength(255),
                ])->columns(2),
                Fieldset::make('Contact')->schema([
                    TextInput::make('email')
                        ->email()
                        ->maxLength(255),
                    TextInput::make('phone_number')
                        ->tel()
                        ->maxLength(255),
                ])->columns(2),
                Fieldset::make('Referral')->schema([
                    TextInput::make('referral_code')
                        ->maxLength(255),
                    Select::make('referral_channel')
                        ->options(ReferralChannel::all()->toSelectArray())
                        ->searchable(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('referral_channel')->sortable(),
                Tables\Columns\TextColumn::make('reference')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('first_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('middle_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('last_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('phone_number')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('test_bookings_count')->label('Bookings')->counts('testBookings')->sortable(),
            ])
            ->filters([
                //
            ])->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\TestBookingsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'view' => Pages\ViewPatient::route('/{record}'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
