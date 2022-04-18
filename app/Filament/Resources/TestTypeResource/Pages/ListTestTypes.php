<?php

namespace App\Filament\Resources\TestTypeResource\Pages;

use App\Filament\Resources\TestTypeResource;
use Filament\Resources\Pages\ListRecords;

class ListTestTypes extends ListRecords
{
    protected static string $resource = TestTypeResource::class;
}
