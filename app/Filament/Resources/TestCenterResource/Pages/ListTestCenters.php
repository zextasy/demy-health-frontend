<?php

namespace App\Filament\Resources\TestCenterResource\Pages;

use App\Filament\Resources\TestCenterResource;
use Filament\Resources\Pages\ListRecords;

class ListTestCenters extends ListRecords
{
    protected static string $resource = TestCenterResource::class;

    public function mount(): void
    {
        abort_unless(auth()->user()->isFilamentAdmin(), 403);
        parent::mount();
    }
}
