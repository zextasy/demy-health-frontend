<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\TestBooking;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use App\Enums\TestBookings\LocationTypeEnum;
use App\Filament\Resources\TestBookingResource\Pages;
use App\Filament\Resources\TestBookingResource\RelationManagers;
use App\Filament\Resources\TestBookingResource\Widgets\TestBookingCalendarWidget;

class TestBookingResource extends Resource
{
    protected static ?string $model = TestBooking::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'reference';

    protected static ?string $navigationGroup = 'CRM';

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasPermissionTo('backend');
    }

    public function mount(): void
    {
        abort_unless(auth()->user()->hasPermissionTo('backend'), 403);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('General Info')->schema([
                    Forms\Components\TextInput::make('reference')
                        ->maxLength(255)
                        ->helperText('Leave this blank and the system will generate one for you'),
                    Forms\Components\BelongsToSelect::make('testType')
                        ->relationship('testType', 'name')
                        ->disabled(),
                    Forms\Components\Select::make('status')
                        ->disabled(),
                ])->columns(1),
                Forms\Components\Fieldset::make('Customer Details')->schema([
                    Forms\Components\TextInput::make('customer_email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\BelongsToSelect::make('patient')
                        ->label('Patient')
                        ->relationship('patient', 'first_name')
                        ->disabled(),
                    Forms\Components\BelongsToSelect::make('user')
                        ->relationship('user', 'name')
                        ->label('User')
                        ->disabled(),
                ]),
                Forms\Components\Fieldset::make('Schedule')->schema([
                    Forms\Components\DateTimePicker::make('due_date')
                        ->label('Scheduled For')
                        ->required(),
                    Forms\Components\TextInput::make('duration_minutes')
                        ->required(),
                ])->columns(3),
                Forms\Components\Fieldset::make('Location')->schema([
                    Forms\Components\Select::make('location_type')
                        ->options(LocationTypeEnum::optionsAsSelectArray())
                        ->required(),
                    Forms\Components\BelongsToSelect::make('testCenter')
                        ->relationship('testCenter', 'name')
                        ->placeholder(''),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('testType.description')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('due_date')
                    ->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('patient.full_name')->label('Patient')->sortable(),
                Tables\Columns\TextColumn::make('customer_email')->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->sortable(),
                //            ->colors([
                //                'gray' => StatusEnum::Booked->value,
                //                'primary'=> '1',//Booked
                //                'danger' => 'none',
                //                'warning' => 'reviewing',
                //                'success' => 'complete',
                //            ])
                Tables\Columns\BadgeColumn::make('location_type')
                    ->enum(LocationTypeEnum::optionsAsSelectArray())
                    ->sortable(),
            ])
            ->filters([

            ])->defaultSort('created_at','desc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\AddressesRelationManager::class,
            RelationManagers\TestResultsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestBookings::route('/'),
            //            'create' => Pages\CreateTestBooking::route('/create'),
            'view' => Pages\ViewTestBooking::route('/{record}'),
//            'edit' => Pages\EditTestBooking::route('/{record}/edit'), //TODO enable editing when the issue with the user relationship is set
        ];
    }

    public static function getWidgets(): array
    {
        return [
            TestBookingCalendarWidget::class,
        ];
    }
}
