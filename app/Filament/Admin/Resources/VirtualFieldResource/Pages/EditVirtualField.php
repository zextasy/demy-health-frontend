<?php

namespace App\Filament\Admin\Resources\VirtualFieldResource\Pages;

use App\Filament\Admin\Resources\VirtualFieldResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVirtualField extends EditRecord
{
    protected static string $resource = VirtualFieldResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
