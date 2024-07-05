<?php

namespace App\Filament\Admin\Resources\Finance;

use App\Constants\Constants;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Finance\Invoice;
use Filament\Resources\Resource;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\Resources\DisplaysCurrencies;
use App\Filament\Admin\Resources\Finance\InvoiceResource\Pages;

use App\Filament\Admin\Resources\Finance\InvoiceResource\RelationManagers;

class InvoiceResource extends Resource
{
    use DisplaysCurrencies;

    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationGroup = 'Finance';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->isFilamentBackendUser();
    }

    public function mount(): void
    {
        abort_unless(auth()->user()->isFilamentBackendUser(), 403);
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
                        ->prefix(self::getSystemDefaultCurrency())
                        ->mask(RawJs::make(Constants::MONEY_INPUT)),
                    TextInput::make('total_discount_amount')
                        ->disabled()
                        ->numeric()
                        ->prefix(self::getSystemDefaultCurrency())
                        ->mask(RawJs::make(Constants::MONEY_INPUT)),
                    TextInput::make('total_amount')
                        ->disabled()
                        ->numeric()
                        ->prefix(self::getSystemDefaultCurrency())
                        ->mask(RawJs::make(Constants::MONEY_INPUT)),
                    TextInput::make('total_transaction_amount')
                        ->label('Total Received')
                        ->disabled()
                        ->numeric()
                        ->prefix(self::getSystemDefaultCurrency())
                        ->mask(RawJs::make(Constants::MONEY_INPUT)),
                    TextInput::make('outstanding_amount')
                        ->disabled()
                        ->numeric()
                        ->prefix(self::getSystemDefaultCurrency())
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
                Tables\Columns\TextColumn::make('outstanding_amount')->money(self::getSystemDefaultCurrency()),
                Tables\Columns\TextColumn::make('status')->badge(),
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

            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ItemsRelationManager::class,
            RelationManagers\TransactionRelationManager::class,
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
