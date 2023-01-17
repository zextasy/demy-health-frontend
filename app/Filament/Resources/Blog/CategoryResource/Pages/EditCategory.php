<?php

namespace App\Filament\Resources\Blog\CategoryResource\Pages;

use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\Blog\CategoryResource;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;
}
