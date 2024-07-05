<?php

namespace App\Filament\Admin\Resources;

use App\Constants\NavigationGroupConstants;
use App\Helpers\HelpTextMessageHelper;
use App\Filament\Admin\Resources\ReferralChannelResource\Pages;

use App\Filament\Admin\Resources\ReferralChannelResource\RelationManagers;
use App\Models\ReferralChannel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class ReferralChannelResource extends Resource
{
    protected static ?string $model = ReferralChannel::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationGroup = NavigationGroupConstants::MARKETING;

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->isFilamentBackendUser();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('referral_code')
                    ->unique()
                    ->maxLength(255)
                    ->helperText(HelpTextMessageHelper::DEFAULT_REFERENCE_SUFFIX),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->unique()
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
            RelationManagers\PatientsRelationManager::class,
            RelationManagers\TestBookingsRelationManager::class,
            RelationManagers\DiscountRelationManager::class,
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
