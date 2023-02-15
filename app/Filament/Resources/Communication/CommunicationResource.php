<?php

namespace App\Filament\Resources\Communication;

use App\Enums\Communication\CommunicationStatusEnum;
use App\Filament\Resources\Communication\CommunicationResource\Pages;
use App\Filament\Resources\Communication\CommunicationResource\RelationManagers;
use App\Models\Communication\Communication;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                Tables\Columns\BadgeColumn::make('status')
                    ->enum(CommunicationStatusEnum::optionsAsSelectArray())->sortable(),
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
