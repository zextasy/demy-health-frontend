<?php

namespace App\Filament\Resources\Blog\AuthorResource\Pages;

use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\Blog\AuthorResource;

class EditAuthor extends EditRecord
{
    protected static string $resource = AuthorResource::class;
}
