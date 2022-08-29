<?php

namespace App\Filament\Resources\Finance;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\Finance\PaymentResource\Pages;
use App\Filament\Resources\Finance\PaymentResource\RelationManagers;
use App\Models\Finance\Payment;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationGroup = 'Finance';

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
                Select::make('payable_id')
                    ->relationship('payable', 'reference')->disabled()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
//                Tables\Columns\TextColumn::make('business_group_id'),
                Tables\Columns\TextColumn::make('reference'),
                Tables\Columns\TextColumn::make('amount')->money('ngn'),
                Tables\Columns\BooleanColumn::make('type'),
                Tables\Columns\TextColumn::make('created_at')->label('Payment Date')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime(),
            ])
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
