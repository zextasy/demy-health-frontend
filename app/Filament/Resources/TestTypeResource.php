<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\Fieldset;
use App\Filament\Resources\TestTypeResource\Pages;
use App\Filament\Resources\TestTypeResource\RelationManagers;
use App\Models\TestType;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class TestTypeResource extends Resource
{
    protected static ?string $model = TestType::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'description';

    protected static ?string $navigationGroup = 'Tests';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('General Info')->schema([
                    Forms\Components\TextInput::make('test_id')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\BelongsToSelect::make('test_category_id')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->required(),
                ]),
                Fieldset::make('Pricing')->schema([
                    Forms\Components\Toggle::make('should_call_in_for_details')
                        ->required(),
                    Forms\Components\TextInput::make('price')
                        ->numeric()
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
                            ->numeric(),
                    ])->columns(3),
                Fieldset::make('Description')->schema([
                    Forms\Components\Textarea::make('description')
                        ->required()
                        ->maxLength(65535),
                ])->columns(1),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('test_id'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('formatted_price')->label('price'),
                Tables\Columns\TextColumn::make('category.name'),
                Tables\Columns\TextColumn::make('tat'),



            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\SpecimenTypesRelationManager::class,
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
