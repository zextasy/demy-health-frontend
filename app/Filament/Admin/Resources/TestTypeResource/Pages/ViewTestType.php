<?php

namespace App\Filament\Admin\Resources\TestTypeResource\Pages;

use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use App\Helpers\HelpTextMessageHelper;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use App\Filament\Admin\Resources\TestTypeResource;
use Filament\Resources\Pages\ViewRecord;
use App\Traits\Resources\DisplaysCurrencies;

class ViewTestType extends ViewRecord
{
    use DisplaysCurrencies;
    protected static string $resource = TestTypeResource::class;

    protected function getFormSchema(): array
    {
        return [
            Fieldset::make('General Info')->schema([
                TextInput::make('test_id')
                    ->maxLength(255)
                    ->helperText(HelpTextMessageHelper::TEST_TYPE_REFERENCE_HELPER_MSG),
                TextInput::make('name')
                    ->maxLength(255)
                    ->helperText('Internal unique name for this test type'),
                Select::make('test_category_id')
                    ->relationship('category', 'name'),
                Select::make('test_result_template_id')
                    ->relationship('testResultTemplate', 'name'),
            ]),
            Fieldset::make('Pricing')->schema([
                Toggle::make('should_call_in_for_details')
                    ->helperText(HelpTextMessageHelper::GENERAL_CALL_IN_MSG),
                TextInput::make('price')->numeric()
                    ->mask(fn (TextInput\Mask $mask) => $mask
                        ->money(self::getSystemDefaultCurrency())
                    ),
            ]),
            Fieldset::make('Turn around time')
                ->schema([
                    TextInput::make('minimum_tat')
                        ->label('Minimum (days)')
                        ->numeric(),
                    TextInput::make('maximum_tat')
                        ->label('Maximum (days)')
                        ->numeric(),
                    TextInput::make('tat_hours')
                        ->label('Hours')
                        ->helperText('Please set minimum and maximum days to 0 to display this'),
                ])->columns(3),
            Fieldset::make('Description')->schema([
                Textarea::make('description')
                    ->maxLength(65535),
            ])->columns(1),

        ];
    }
}
