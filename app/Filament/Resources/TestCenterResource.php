<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestCenterResource\Pages;
use App\Filament\Resources\TestCenterResource\RelationManagers;
use App\Models\TestCenter;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class TestCenterResource extends Resource
{
    protected static ?string $model = TestCenter::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Tests';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
//                Tables\Columns\TextColumn::make('latestAddress.line_1')
//                    ->label('address'),
//                Tables\Columns\TextColumn::make('latestAddress.state.name')
//                    ->label('state'),
//                Tables\Columns\TextColumn::make('latestAddress.localGovernmentArea.name')
//                    ->label('LGA'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListTestCenters::route('/'),
            'create' => Pages\CreateTestCenter::route('/create'),
            'view' => Pages\ViewTestCenter::route('/{record}'),
            'edit' => Pages\EditTestCenter::route('/{record}/edit'),
        ];
    }
}
