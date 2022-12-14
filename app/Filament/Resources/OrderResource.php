<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Order;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use App\Traits\Resources\DisplaysCurrencies;
use App\Filament\Resources\OrderResource\Pages;
use App\Enums\Finance\Payments\PaymentMethodEnum;
use App\Filament\Resources\OrderResource\RelationManagers;

class OrderResource extends Resource
{
    use DisplaysCurrencies;

    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'CRM';

    protected static ?int $navigationSort = 5;

    protected static function shouldRegisterNavigation(): bool
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
                    ->helperText('Leave this blank and the system will generate a reference')
                    ->maxLength(255),
                TextInput::make('customer_email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('total_amount')
                    ->disabled()
                    ->numeric()
                    ->mask(fn (TextInput\Mask $mask) => $mask
                        ->numeric()
                        ->decimalPlaces(2) // Set the number of digits after the decimal point.
                        ->decimalSeparator('.') // Add a separator for decimal numbers.
                        ->thousandsSeparator(',') // Add a separator for thousands.
                    ),
                Select::make('payment_method')
                    ->options(PaymentMethodEnum::optionsAsSelectArray())
                    ->disabled(),
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
                Tables\Columns\BadgeColumn::make('status')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->sortable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->sortable()
                    ->dateTime(),
            ])
            ->filters([
                //
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
