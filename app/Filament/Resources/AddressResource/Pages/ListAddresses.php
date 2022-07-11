<?php

namespace App\Filament\Resources\AddressResource\Pages;

use App\Filament\Resources\AddressResource;
use Filament\Resources\Pages\ListRecords;

class ListAddresses extends ListRecords
{
    protected static string $resource = AddressResource::class;

    public function mount(): void
    {
        abort_unless(auth()->user()->isFilamentAdmin(), 403);
        parent::mount();
    }
}
