<?php

namespace App\Filament\Resources\TestTypeResource\Pages;

use Filament\Forms\Form;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\TestTypeResource;
use Filament\Resources\Pages\EditRecord;

class EditTestType extends EditRecord
{
    protected static string $resource = TestTypeResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('General Info')->schema([
                    TextInput::make('test_id')
                        ->maxLength(255)
                        ->helperText('Internal unique reference for this test type. Leave blank and the system will generate one for you'),
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->helperText('Internal unique name for this test type'),
                    Select::make('test_category_id')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->required(),
                    Select::make('test_result_template_id')
                        ->relationship('testResultTemplate', 'name')
                        ->searchable(),
                ]),
                Fieldset::make('Pricing')->schema([
                    Toggle::make('should_call_in_for_details')
                        ->helperText('If this is selected, customers will not see the price of this item and will be asked to call in instead')
                        ->required(),
                ]),
                Fieldset::make('Turn around time')
                    ->schema([
                        TextInput::make('minimum_tat')
                            ->label('Minimum (days)')
                            ->numeric()
                            ->required(),
                        TextInput::make('maximum_tat')
                            ->label('Maximum (days)')
                            ->numeric()
                            ->required(),
                        TextInput::make('tat_hours')
                            ->label('Hours')
                            ->helperText('Please set minimum and maximum days to 0 to display this')
                            ->numeric()
                            ->required()
                            ->default(0),
                    ])->columns(3),
                Fieldset::make('Description')->schema([
                    Textarea::make('description')
                        ->maxLength(65535),
                ])->columns(1),

            ]);
    }
}
