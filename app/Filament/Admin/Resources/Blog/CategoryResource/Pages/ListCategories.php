<?php

namespace App\Filament\Admin\Resources\Blog\CategoryResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Admin\Resources\Blog\CategoryResource;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;
}
