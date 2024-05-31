<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\TestBooking;
use Filament\Resources\Resource;
use App\Helpers\HelpTextMessageHelper;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Enums\TestBookings\LocationTypeEnum;
use App\Filament\Admin\Resources\TestBookingResource\Pages;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Filament\Admin\Resources\TestBookingResource\RelationManagers;
use App\Filament\Admin\Resources\TestBookingResource\Widgets\TestBookingCalendarWidget;

class TestBookingResource extends Resource
{
    protected static ?string $model = TestBooking::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $recordTitleAttribute = 'reference';

    protected static ?string $navigationGroup = 'CRM';

    protected static ?int $navigationSort = 5;

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasPermissionTo('backend');
    }

    public function mount(): void
    {
        abort_unless(auth()->user()->hasPermissionTo('backend'), 403);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['patient','testType']);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('General Info')->schema([
                    Forms\Components\TextInput::make('reference')
                        ->maxLength(255)
                        ->unique()
                        ->helperText(HelpTextMessageHelper::DEFAULT_REFERENCE_SUFFIX),
                    Forms\Components\BelongsToSelect::make('testType')
                        ->relationship('testType', 'name')
                        ->disabled(),
                    Forms\Components\Select::make('status')
                        ->disabled(),
                    Forms\Components\TextInput::make('duration_minutes')
                        ->disabled(),
                ])->columns(2),
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
                TextColumn::make('reference')->searchable()->sortable(),
                TextColumn::make('testType.name')->searchable()->sortable(),
                TextColumn::make('due_date')
                    ->dateTime()->sortable(),
                TextColumn::make('patient.full_name')->label('Patient'),
                TextColumn::make('customer_email')->sortable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('location_type')
                    ->badge()
                    ->sortable(),
            ])
            ->filters([

            ])
            ->bulkActions([
                FilamentExportBulkAction::make('export'),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\TestResultsRelationManager::class,
            RelationManagers\AssignedTasksRelationManager::class,
//            RelationManagers\ActionableTasksRelationManager::class,
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
            //TODO enable editing when the issue with the user relationship is set
        ];
    }

    public static function getWidgets(): array
    {
        return [
            TestBookingCalendarWidget::class,
        ];
    }
}
