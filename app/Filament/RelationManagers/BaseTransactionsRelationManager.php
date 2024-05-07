<?php

namespace App\Filament\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Fieldset;
use App\Traits\Resources\DisplaysCurrencies;
use Filament\Resources\RelationManagers\RelationManager;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;

class BaseTransactionsRelationManager extends RelationManager
{
    use DisplaysCurrencies;

    protected static string $relationship = 'transactions';

    protected static ?string $recordTitleAttribute = 'reference';

    protected static ?string $title = 'Transactions';

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
            ->schema([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('amount')->money(self::getSystemDefaultCurrency())
                    ->label('Price')->sortable(),
                Tables\Columns\TextColumn::make('reference')->label('Reference')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('Date')->date()->sortable(),
//                Tables\Columns\TextColumn::make('debitable.id')->label('Source'),
//                Tables\Columns\TextColumn::make('creditable.id')->label('Destination'),
            ])
            ->filters([])
            ->headerActions([])
            ->actions([])
            ->bulkActions([
                FilamentExportBulkAction::make('export'),
            ]);
    }
}
