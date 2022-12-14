<?php

namespace App\Filament\Resources\Finance;

use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use App\Models\Finance\Payment;
use Filament\Resources\Resource;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use App\Traits\Resources\DisplaysCurrencies;
use App\Enums\Finance\Payments\PaymentMethodEnum;
use App\Filament\Resources\Finance\PaymentResource\Pages;
use App\Filament\Resources\Finance\PaymentResource\RelationManagers;

class PaymentResource extends Resource
{
    use DisplaysCurrencies;

    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationGroup = 'Finance';

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->hasPermissionTo('backend');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
//                TextInput::make('business_group_id')
//                    ->required(),
                TextInput::make('reference')
                    ->required()
                    ->maxLength(255),
                TextInput::make('amount')
                    ->required(),
                Toggle::make('type')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
//                Tables\Columns\TextColumn::make('business_group_id'),
                Tables\Columns\TextColumn::make('reference'),
                Tables\Columns\TextColumn::make('amount')->money(self::getSystemDefaultCurrency()),
                Tables\Columns\BadgeColumn::make('payment_method')
                    ->enum(PaymentMethodEnum::optionsAsSelectArray())->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('Payment Date')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
//                Tables\Actions\EditAction::make(),
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
//            'create' => Pages\CreatePayment::route('/create'),
            'view' => Pages\ViewPayment::route('/{record}'),
//            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
