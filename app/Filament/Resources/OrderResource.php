<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Order;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use App\Traits\Resources\DisplaysCurrencies;
use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;

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
                        ->mask(fn (TextInput\Mask $mask) => $mask
                            ->money(self::getSystemDefaultCurrency())
                        ),
                    TextInput::make('total_discount_amount')
                        ->disabled()
                        ->numeric()
                        ->mask(fn (TextInput\Mask $mask) => $mask
                            ->money(self::getSystemDefaultCurrency())
                        ),
                    TextInput::make('total_amount')
                        ->disabled()
                        ->numeric()
                        ->mask(fn (TextInput\Mask $mask) => $mask
                            ->money(self::getSystemDefaultCurrency())
                        ),
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
                Tables\Columns\BadgeColumn::make('status'),
                Tables\Columns\TextColumn::make('created_at')->sortable()
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->bulkActions([
                FilamentExportBulkAction::make('export'),
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
