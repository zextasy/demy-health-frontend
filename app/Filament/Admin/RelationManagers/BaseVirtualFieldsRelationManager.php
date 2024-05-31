<?php

namespace App\Filament\Admin\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use App\Enums\FieldTypeEnum;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class BaseVirtualFieldsRelationManager extends RelationManager
{
    protected static string $relationship = 'virtualFields';

    protected static ?string $recordTitleAttribute = 'label';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label'),
                Tables\Columns\TextColumn::make('field_type')->label('Field Type')
                    ->badge(),
                Tables\Columns\TextColumn::make('display_weight'),
                Tables\Columns\IconColumn::make('is_required')->boolean(),
//                Tables\Columns\IconColumn::make('should_display_on_index')->boolean(),
//                Tables\Columns\IconColumn::make('is_searchable')->boolean(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make(),
            ])
            ->actions([
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([

            ]);
    }
}
