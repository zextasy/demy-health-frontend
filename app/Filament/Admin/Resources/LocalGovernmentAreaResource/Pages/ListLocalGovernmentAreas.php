<?php

namespace App\Filament\Admin\Resources\LocalGovernmentAreaResource\Pages;

use App\Filament\Admin\Resources\LocalGovernmentAreaResource;
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
