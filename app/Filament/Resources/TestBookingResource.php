<?php

namespace App\Filament\Resources;

use App\Enums\TestBooking\StatusEnum;
use App\Enums\TestBooking\LocationTypeEnum;
use App\Filament\Resources\TestBookingResource\Pages;
use App\Filament\Resources\TestBookingResource\RelationManagers;
use App\Models\TestBooking;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use App\Filament\Resources\TestBookingResource\Widgets\TestBookingCalendarWidget;

class TestBookingResource extends Resource
{
    protected static ?string $model = TestBooking::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'reference';

    protected static ?string $navigationGroup = 'Tests';

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasPermissionTo('admin');
    }

    public function mount(): void
    {
        abort_unless(auth()->user()->hasPermissionTo('admin'), 403);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('General Info')->schema([
                    Forms\Components\TextInput::make('reference')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\BelongsToSelect::make('testType')
                        ->relationship('testType','description')
                        ->required(),
                    Forms\Components\Select::make('status')
                        ->options(StatusEnum::optionsAsSelectArray())
                        ->required(),
                ])->columns(1),
                Forms\Components\Fieldset::make('Customer Details')->schema([
                    Forms\Components\TextInput::make('customer_email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\BelongsToSelect::make('user')
                        ->relationship('user', 'name')
                        ->placeholder(''),
                ]),
                Forms\Components\Fieldset::make('Schedule')->schema([
                    Forms\Components\DatePicker::make('due_date')
                        ->required(),
                    Forms\Components\TextInput::make('start_time')
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
                Tables\Columns\TextColumn::make('reference')->searchable(),
                Tables\Columns\TextColumn::make('testType.description')->searchable(),
                Tables\Columns\TextColumn::make('due_date')
                    ->date(),
                Tables\Columns\TextColumn::make('customer_email'),
                Tables\Columns\BadgeColumn::make('status')
                    ->enum(StatusEnum::optionsAsSelectArray()),
//            ->colors([
//                'gray' => StatusEnum::Booked->value,
//                'primary'=> '1',//Booked
//                'danger' => 'none',
//                'warning' => 'reviewing',
//                'success' => 'complete',
//            ])
                Tables\Columns\BadgeColumn::make('location_type')
                    ->enum(LocationTypeEnum::optionsAsSelectArray()),
            ])
            ->filters([

            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\AddressesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestBookings::route('/'),
//            'create' => Pages\CreateTestBooking::route('/create'),
            'view' => Pages\ViewTestBooking::route('/{record}'),
//            'edit' => Pages\EditTestBooking::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            TestBookingCalendarWidget::class,
        ];
    }
}
