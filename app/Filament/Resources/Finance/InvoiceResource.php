<?php

namespace App\Filament\Resources\Finance;

use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\Finance\Invoice;
use Filament\Resources\Resource;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\Resources\DisplaysCurrencies;
use App\Enums\Finance\Invoices\InvoiceStatusEnum;
use App\Filament\Resources\Finance\InvoiceResource\Pages;
use App\Filament\Resources\Finance\InvoiceResource\RelationManagers;

class InvoiceResource extends Resource
{
    use DisplaysCurrencies;

    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationGroup = 'Finance';

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasPermissionTo('backend');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('invoiceable');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('reference')
                    ->helperText('Leave this blank and the system will generate a reference')
                    ->unique()
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
                    TextInput::make('total_transaction_amount')
                        ->label('Total Received')
                        ->disabled()
                        ->numeric()
                        ->mask(fn (TextInput\Mask $mask) => $mask
                            ->money(self::getSystemDefaultCurrency())
                        ),
                    TextInput::make('outstanding_amount')
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
                Tables\Columns\TextColumn::make('outstanding_amount')->money(self::getSystemDefaultCurrency()),
                Tables\Columns\BadgeColumn::make('status'),
//                    ->color(static function ($state): string {
//                        return InvoiceStatusEnum::getDisplayColor($state);
//                    }),
                Tables\Columns\TextColumn::make('created_at')->sortable()
                    ->dateTime(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
            'index' => Pages\ListInvoices::route('/'),
//            'create' => Pages\CreateInvoice::route('/create'),
            'view' => Pages\ViewInvoice::route('/{record}'),
//            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
