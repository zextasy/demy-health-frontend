<?php

namespace App\Filament\Admin\RelationManagers;

use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use App\Traits\Resources\DisplaysCurrencies;
use App\Enums\Finance\Payments\PaymentMethodEnum;
use Filament\Resources\RelationManagers\RelationManager;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;

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

    public function form(Form $form): Form
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

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference')->searchable(),
                Tables\Columns\TextColumn::make('amount')->money(self::getSystemDefaultCurrency())->searchable(),
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
            ->actions([])
            ->bulkActions([
                FilamentExportBulkAction::make('export'),
            ]);
    }
}
