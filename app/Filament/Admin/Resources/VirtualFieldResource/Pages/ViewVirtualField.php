<?php

namespace App\Filament\Admin\Resources\VirtualFieldResource\Pages;

use App\Filament\Admin\Resources\VirtualFieldResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVirtualField extends ViewRecord
{
    protected static string $resource = VirtualFieldResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
