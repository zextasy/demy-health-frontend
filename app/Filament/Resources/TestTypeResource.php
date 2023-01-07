<?php

namespace App\Filament\Resources;

use App\Settings\GeneralSettings;
use App\Traits\Resources\DisplaysCurrencies;
use App\Filament\Resources\TestTypeResource\Pages;
use App\Filament\Resources\TestTypeResource\RelationManagers;
use App\Models\TestType;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class TestTypeResource extends Resource
{
    use DisplaysCurrencies;
    protected static ?string $model = TestType::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Tests';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('General Info')->schema([
                    Forms\Components\TextInput::make('test_id')
                        ->maxLength(255)
                        ->unique()
                        ->helperText('Internal unique reference for this test type. Leave blank and the system will generate one for you'),
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->unique()
                        ->helperText('Internal unique name for this test type'),
                    Forms\Components\Select::make('test_category_id')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->required(),
                    Forms\Components\Select::make('test_result_template_id')
                        ->relationship('testResultTemplate', 'name')
                        ->searchable(),
                ]),
                Fieldset::make('Pricing')->schema([
                    Forms\Components\Toggle::make('should_call_in_for_details')
                        ->helperText('If this is selected, customers will not see the price of this item and will be asked to call in instead')
                        ->required(),
                ]),
                Fieldset::make('Turn around time')
                    ->schema([
                        Forms\Components\TextInput::make('minimum_tat')
                            ->label('Minimum (days)')
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('maximum_tat')
                            ->label('Maximum (days)')
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('tat_hours')
                            ->label('Hours')
                            ->helperText('Please set minimum and maximum days to 0 to display this')
                            ->numeric()
                            ->required()
                            ->default(0),
                    ])->columns(3),
                Fieldset::make('Description')->schema([
                    Forms\Components\Textarea::make('description')
                        ->maxLength(65535),
                ])->columns(1),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('test_id')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('price')->money(self::getSystemDefaultCurrency())->sortable(),
                Tables\Columns\TextColumn::make('category.name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('tat')->sortable(),
                Tables\Columns\TextColumn::make('test_bookings_count')
                    ->counts('testBookings')
                    ->label('Bookings')
                    ->sortable(),
                Tables\Columns\TextColumn::make('testResultTemplate.name')->label('Template')
                    ->searchable()->sortable(),
            ])
            ->filters([
                //
            ])
            ->defaultSort('test_id');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PricesRelationManager::class,
            RelationManagers\SpecimenTypesRelationManager::class,
            RelationManagers\TestBookingsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestTypes::route('/'),
            'create' => Pages\CreateTestType::route('/create'),
            'view' => Pages\ViewTestType::route('/{record}'),
            'edit' => Pages\EditTestType::route('/{record}/edit'),
        ];
    }
}
