<?php

namespace App\Filament\Resources;


use App\Filament\Resources\OrderResource\Pages;
use App\Enums\Finance\Payments\PaymentMethodEnum;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'CRM';

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
                Forms\Components\TextInput::make('reference')
                    ->helperText('Leave this blank and the system will generate a reference')
                    ->maxLength(255),
                Forms\Components\TextInput::make('customer_email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('total_amount')
                    ->disabled()
                    ->numeric(),
                Forms\Components\Select::make('payment_type')
                    ->options(PaymentMethodEnum::optionsAsSelectArray())
                    ->disabled(),
                Forms\Components\TextInput::make('status')
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('customer_email')->searchable()->sortable(),
                Tables\Columns\BadgeColumn::make('payment_type')->sortable()
                    ->enum(PaymentMethodEnum::optionsAsSelectArray()),
                Tables\Columns\BadgeColumn::make('status')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->sortable()
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->sortable()
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->defaultSort('created_at','desc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
//            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
