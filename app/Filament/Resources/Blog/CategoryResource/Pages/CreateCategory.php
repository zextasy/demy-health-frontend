<?php

namespace App\Filament\Resources\Blog\CategoryResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\Blog\CategoryResource;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
}
