<?php

namespace App\Filament\Resources\TestResultResource\Pages;

use Filament\Forms\Components\Hidden;
use App\Services\VirtualFieldService;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\TestResultResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class ViewTestResult extends ViewRecord
{
    protected static string $resource = TestResultResource::class;

    protected function getFormSchema(): array
    {
        $testResultTemplate = $this->record->testBooking->testType->testResultTemplate;

        $basicFields = [
            Hidden::make('test_booking_id'),
            Section::make('General Info')
                ->columns(2)
                ->schema([
                    TextInput::make('customer_email'),
                    TextInput::make('customer_phone_number'),
                ]),
            Section::make('Result File')->schema([
                SpatieMediaLibraryFileUpload::make('result')
                    ->multiple()
                    ->collection('result')
                    ->enableReordering()->enableOpen()
                    ->helperText('Please click the square icon with an arrow to view the result'),
            ])->columns(1),
        ];

        $extraFields = [
            Section::make('Result Info')
                ->columns(2)
                ->schema((new VirtualFieldService)->getFilamentFormFields($testResultTemplate)),
        ];
        return array_merge($basicFields, $extraFields);
    }
}
