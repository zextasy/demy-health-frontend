<?php

namespace App\Filament\RelationManagers;

use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use App\Traits\Resources\DisplaysCurrencies;
use App\Enums\Finance\Payments\PaymentMethodEnum;
use Filament\Resources\RelationManagers\RelationManager;

class BasePaymentsRelationManager extends RelationManager
{
    use DisplaysCurrencies;

    protected static string $relationship = 'payments';

    protected static ?string $recordTitleAttribute = 'amount';

    protected static ?string $title = 'Payments';

    protected function canCreate(): bool
    {
        return false;
    }

    protected function canAttach(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('reference')
                    ->required()
                    ->unique()
                    ->maxLength(255)
                    ->disabled(),
                TextInput::make('status')
                    ->disabled(),
                TextInput::make('payer_name')
                    ->label("Paid By")
                    ->disabled(),
                Select::make('payment_method')
                    ->options(PaymentMethodEnum::optionsAsSelectArray())
                    ->disabled(),
                TextInput::make('amount')
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference'),
                Tables\Columns\TextColumn::make('amount')->money(self::getSystemDefaultCurrency()),
                Tables\Columns\TextColumn::make('balance')->money(self::getSystemDefaultCurrency()),
                Tables\Columns\BadgeColumn::make('payment_method')
                    ->enum(PaymentMethodEnum::optionsAsSelectArray())->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('Payment Date')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('status'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Set New Price'),
            ])
            ->actions([]);
    }
}
