<?php

namespace App\Filament\Resources\LocalGovernmentAreaResource\Pages;

use App\Filament\Resources\LocalGovernmentAreaResource;
use Filament\Resources\Pages\ListRecords;

class ListLocalGovernmentAreas extends ListRecords
{
    protected static string $resource = LocalGovernmentAreaResource::class;

    public function mount(): void
    {
        abort_unless(auth()->user()->isFilamentAdmin(), 403);
        parent::mount();
    }
}
