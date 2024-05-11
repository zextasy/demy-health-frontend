<?php

namespace App\Filament\Admin\Resources\TestCenterResource\Pages;

use App\Filament\Admin\Resources\TestCenterResource;
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
