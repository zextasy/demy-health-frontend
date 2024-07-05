<?php

namespace App\Filament\Admin\Resources\Finance;

use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Finance\Payment;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\Resources\DisplaysCurrencies;
use App\Enums\Finance\Payments\PaymentMethodEnum;
use App\Filament\Admin\Resources\Finance\PaymentResource\Pages;


class PaymentResource extends Resource
{
    use DisplaysCurrencies;

    protected static ?string $model = Payment::class;

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
        return parent::getEloquentQuery()->with(['payer']);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
//                TextInput::make('business_group_id')
//                    ->required(),
                TextInput::make('reference')
                    ->required()
                    ->unique()
                    ->maxLength(255),
                TextInput::make('status')
                    ->disabled(),
                TextInput::make('payer_name')
                    ->label("Paid By")
                    ->disabled(),
                Select::make('payment_method')
                    ->options(PaymentMethodEnum::class)
                    ->disabled(),
                TextInput::make('amount')
                    ->prefix(self::getSystemDefaultCurrency())
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
//                Tables\Columns\TextColumn::make('business_group_id'),
                Tables\Columns\TextColumn::make('reference'),
                Tables\Columns\TextColumn::make('amount')->money(self::getSystemDefaultCurrency()),
                Tables\Columns\TextColumn::make('balance')->money(self::getSystemDefaultCurrency()),
                Tables\Columns\TextColumn::make('payment_method')->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('Payment Date')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('payer_name')->label('Paid By'),
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
//                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'view' => Pages\ViewPayment::route('/{record}'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return true;
    }
}
