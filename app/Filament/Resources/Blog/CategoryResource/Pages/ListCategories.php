<?php

namespace App\Filament\Resources\Blog\CategoryResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Blog\CategoryResource;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;
}
