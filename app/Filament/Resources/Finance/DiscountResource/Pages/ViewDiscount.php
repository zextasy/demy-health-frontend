<?php

namespace App\Filament\Resources\Finance\DiscountResource\Pages;

use Filament\Resources\Form;
use App\Models\Finance\Discount;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use App\Enums\Finance\Discounts\DiscountTypeEnum;
use App\Filament\Resources\Finance\DiscountResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDiscount extends ViewRecord
{
    protected static string $resource = DiscountResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make()
                ->visible(fn (Discount $record): bool => $record->hasNotBeenApplied()),
        ];
    }

    protected function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('code')
                    ->required()
                    ->unique()
                    ->maxLength(255),
                TextInput::make('name')
                    ->required()
                    ->unique()
                    ->maxLength(255),
                Select::make('type')
                    ->options(DiscountTypeEnum::optionsAsSelectArray())
                    ->required(),
                TextInput::make('discount_value')
                    ->required(),
            ]);
    }
}
