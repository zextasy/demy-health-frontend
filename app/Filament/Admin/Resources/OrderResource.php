<?php

namespace App\Filament\Admin\Resources;

use App\Constants\Constants;
use Filament\Support\RawJs;
use Filament\Tables;
use App\Models\Order;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use App\Traits\Resources\DisplaysCurrencies;
use App\Filament\Admin\Resources\OrderResource\Pages;
use App\Filament\Admin\Resources\OrderResource\RelationManagers;


class OrderResource extends Resource
{
    use DisplaysCurrencies;

    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationGroup = 'CRM';

    protected static ?int $navigationSort = 5;

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasPermissionTo('backend');
    }

    public function mount(): void
    {
        abort_unless(auth()->user()->hasPermissionTo('backend'), 403);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('reference')
                    ->unique()
                    ->helperText('Leave this blank and the system will generate a reference')
                    ->maxLength(255),
                TextInput::make('customer_email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Fieldset::make('Financial Info')->schema([
                    TextInput::make('sub_total_amount')
                        ->disabled()
                        ->numeric()
                        ->prefix(self::getSystemDefaultCurrency())
                        ->mask(RawJs::make(Constants::MONEY_INPUT)),
                    TextInput::make('total_discount_amount')
                        ->disabled()
                        ->numeric()
                        ->mask(RawJs::make(Constants::MONEY_INPUT)),
                    TextInput::make('total_amount')
                        ->disabled()
                        ->numeric()
                        ->mask(RawJs::make(Constants::MONEY_INPUT)),
                ])->columns(3),
                TextInput::make('status')
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('customer_email')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('total_amount')->money(self::getSystemDefaultCurrency()),
                Tables\Columns\TextColumn::make('status')->badge(),
                Tables\Columns\TextColumn::make('created_at')->sortable()
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->bulkActions([

            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ItemsRelationManager::class,
            RelationManagers\DiscountRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            //            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
//            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }


}
