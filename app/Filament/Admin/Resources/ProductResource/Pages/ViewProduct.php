<?php

namespace App\Filament\Admin\Resources\ProductResource\Pages;

use App\Constants\Constants;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use App\Helpers\HelpTextMessageHelper;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use App\Filament\Admin\Resources\ProductResource;
use Filament\Resources\Pages\ViewRecord;
use App\Traits\Resources\DisplaysCurrencies;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Support\RawJs;

class ViewProduct extends ViewRecord
{
    protected static string $resource = ProductResource::class;

    use DisplaysCurrencies;

    protected function getFormSchema(): array
    {
        return [
            Fieldset::make('Pictures')->schema([
                SpatieMediaLibraryFileUpload::make('pictures')
                    ->image()
                    ->multiple()
                    ->collection('pictures')
                    ->enableReordering()
                    ->enableOpen(),
            ])->columns(1),
            Fieldset::make('Pricing')->schema([
                Toggle::make('should_call_in_for_details')
                    ->helperText(HelpTextMessageHelper::GENERAL_CALL_IN_MSG),
                TextInput::make('price')
                    ->numeric()
                    ->prefix(self::getSystemDefaultCurrency())
                    ->mask(RawJs::make(Constants::MONEY_INPUT)),
            ]),
            Fieldset::make('General Info')->schema([
                TextInput::make('sku')
                    ->label('SKU')
                    ->unique()
                    ->maxLength(255),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('model')
                    ->maxLength(255),
                TextInput::make('country')
                    ->maxLength(255),
                Select::make('categories')
                    ->relationship('productCategories', 'name')
                    ->multiple(),
            ]),
            Fieldset::make('Pricing')->schema([
                Toggle::make('should_call_in_for_details')
                    ->required(),
            ]),
            Fieldset::make('Extra Info')->schema([
                KeyValue::make('extra_information'),
            ])->columns(1),

        ];
    }
}
