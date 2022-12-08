<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReferralChannelResource\Pages;
use App\Models\ReferralChannel;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ReferralChannelResource extends Resource
{
    protected static ?string $model = ReferralChannel::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Marketing';

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->isFilamentBackendUser();
    }

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
            'index' => Pages\ListReferralChannels::route('/'),
            'create' => Pages\CreateReferralChannel::route('/create'),
            'view' => Pages\ViewReferralChannel::route('/{record}'),
            'edit' => Pages\EditReferralChannel::route('/{record}/edit'),
        ];
    }
}
