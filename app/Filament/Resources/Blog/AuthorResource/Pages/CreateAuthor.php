<?php

namespace App\Filament\Resources\Blog\AuthorResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\Blog\AuthorResource;

class CreateAuthor extends CreateRecord
{
    protected static string $resource = AuthorResource::class;
}
