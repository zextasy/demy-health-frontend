<?php

namespace App\Filament\Resources\Communication\CommunicationResource\Pages;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DateTimePicker;
use App\Enums\Communication\CommunicationStatusEnum;
use App\Enums\Communication\CommunicationChannelEnum;
use App\Filament\Resources\Communication\CommunicationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Actions\Pages\Communications\ReSendCommunicationAction;

class ViewCommunication extends ViewRecord
{
    protected static string $resource = CommunicationResource::class;

    protected function getFormSchema(): array
    {
        return [
            Fieldset::make('General')
                ->schema([
                    Select::make('channel')
                        ->options(CommunicationChannelEnum::optionsAsSelectArray()),
                    Select::make('status')
                        ->options(CommunicationStatusEnum::optionsAsSelectArray()),
                    TextInput::make('contact_name')->label('Sent to'),
                    TextInput::make('contact_details'),
                ])
                ->columns(2),
            Fieldset::make('Content')
                ->schema([
                    RichEditor::make('content'),
                ])->columns(1),
            Fieldset::make('Dispatch')
                ->schema([
                    TextInput::make('tries')
                        ->numeric()
                        ->required(),
                    DateTimePicker::make('last_tired_at'),
                    DateTimePicker::make('sent_at'),
                    DateTimePicker::make('resend_at'),
                ])
                ->columns(4),
        ];
    }

    protected function getActions(): array
    {
        return [
            ReSendCommunicationAction::make()->communication($this->record)
            ->visible($this->record->canBeSent()),
            Actions\EditAction::make(),
        ];
    }
}
