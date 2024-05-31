<?php

namespace App\Filament\Admin\Resources\Communication;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\Communication\Communication;
use App\Filament\Admin\Resources\Communication\CommunicationResource\Pages;
use App\Filament\Admin\Resources\Communication\CommunicationResource\RelationManagers;

class CommunicationResource extends Resource
{
    protected static ?string $model = Communication::class;

    protected static ?string $navigationIcon = 'heroicon-o-at-symbol';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('communication_type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('communication_id')
                    ->required(),
                Forms\Components\TextInput::make('communicable_type')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('communicable_id')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->required(),
                Forms\Components\TextInput::make('tries')
                    ->numeric()
                    ->required(),
                Forms\Components\DateTimePicker::make('last_tired_at'),
                Forms\Components\DateTimePicker::make('sent_at'),
                Forms\Components\DateTimePicker::make('resend_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('communicable.full_name')->label('Sent to')
                    ->sortable(),
                Tables\Columns\TextColumn::make('communication.channel')->label('Channel')
                ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()->sortable(),
                Tables\Columns\TextColumn::make('tries')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
//                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCommunications::route('/'),
//            'create' => Pages\CreateCommunication::route('/create'),
            'view' => Pages\ViewCommunication::route('/{record}'),
            'edit' => Pages\EditCommunication::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
