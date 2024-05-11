<?php

namespace App\Filament\Admin\Resources\Blog\AuthorResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Admin\Resources\Blog\AuthorResource;

class CreateAuthor extends CreateRecord
{
    protected static string $resource = AuthorResource::class;
}
