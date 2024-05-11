<?php

namespace App\Filament\Admin\Resources\Blog\CategoryResource\Pages;

use Filament\Resources\Pages\EditRecord;
use App\Filament\Admin\Resources\Blog\CategoryResource;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;
}
