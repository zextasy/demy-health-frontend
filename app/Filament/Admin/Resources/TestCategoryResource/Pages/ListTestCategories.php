<?php

namespace App\Filament\Admin\Resources\TestCategoryResource\Pages;

use App\Filament\Admin\Resources\TestCategoryResource;
use Filament\Resources\Pages\ListRecords;

class ListTestCategories extends ListRecords
{
    protected static string $resource = TestCategoryResource::class;
}
