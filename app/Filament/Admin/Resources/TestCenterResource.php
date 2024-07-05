<?php

namespace App\Filament\Admin\Resources;

use App\Constants\NavigationGroupConstants;
use App\Filament\Admin\Resources\TestCenterResource\Pages;
use App\Filament\Admin\Resources\TestCenterResource\RelationManagers;
use App\Models\TestCenter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;


class TestCenterResource extends Resource
{
    protected static ?string $model = TestCenter::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = NavigationGroupConstants::TESTS;

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
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
            ])
            ->filters([
                //
            ])
            ->bulkActions([

            ])
            ->defaultSort('name');
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
