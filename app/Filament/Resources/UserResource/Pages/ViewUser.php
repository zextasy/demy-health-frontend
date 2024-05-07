<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Pages\Actions\EditAction;
use Filament\Pages\Actions\ActionGroup;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\ViewRecord;
use App\Enums\Communication\CommunicationChannelEnum;
use App\Filament\Actions\Pages\Communications\SendCommunicationAction;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ActionGroup::make([
                SendCommunicationAction::make()->communicable($this->record)
                    ->visible($this->record->hasValidRoute(CommunicationChannelEnum::EMAIL())),
            ])->icon('heroicon-s-at-symbol')->label('Communication'),
            EditAction::make(),
        ];
    }
}
