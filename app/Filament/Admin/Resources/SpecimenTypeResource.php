<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SpecimenTypeResource\Pages;
use App\Filament\Admin\Resources\SpecimenTypeResource\RelationManagers;
use App\Models\SpecimenType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;


class SpecimenTypeResource extends Resource
{
    protected static ?string $model = SpecimenType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'description';

    protected static ?string $navigationGroup = 'Tests';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('key')
                    ->required()
                    ->unique()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('description')->searchable()->sortable(),

            ])
            ->filters([
                //
            ])
            ->bulkActions([

            ])
            ->defaultSort('key');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\TestTypesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSpecimenTypes::route('/'),
            'create' => Pages\CreateSpecimenType::route('/create'),
            'view' => Pages\ViewSpecimenType::route('/{record}'),
            'edit' => Pages\EditSpecimenType::route('/{record}/edit'),
        ];
    }
}
