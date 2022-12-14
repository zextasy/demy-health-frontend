<?php

namespace App\Filament\Actions\Pages\TestBookings;

use Closure;
use App\Models\Product;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use App\Enums\TestBookings\LocationTypeEnum;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Actions\Pages\BasePageAction;

class BookATestForPatientAction extends BasePageAction
{

    public function getFormSchema(): array
    {
        return [
            Fieldset::make('General Info')->schema([
                TextInput::make('reference')
                    ->maxLength(255)
                    ->helperText('Leave this blank and the system will generate one for you'),
                Select::make('testType')
                    ->relationship('testType', 'name')
                    ->disabled(),
                Select::make('status')
                    ->disabled(),
            ])->columns(1),
            Fieldset::make('Customer Details')->schema([
                TextInput::make('customer_email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Select::make('patient')
                    ->label('Patient')
                    ->relationship('patient', 'first_name')
                    ->disabled(),
                Select::make('user')
                    ->relationship('user', 'name')
                    ->label('User')
                    ->disabled(),
            ]),
            Fieldset::make('Schedule')->schema([
                DateTimePicker::make('due_date')
                    ->label('Scheduled For')
                    ->required(),
                TextInput::make('duration_minutes')
                    ->required(),
            ])->columns(3),
            Fieldset::make('Location')->schema([
                Select::make('location_type')
                    ->options(LocationTypeEnum::optionsAsSelectArray())
                    ->required(),
                Select::make('testCenter')
                    ->relationship('testCenter', 'name')
                    ->placeholder(''),
            ]),
        ];
    }
}
