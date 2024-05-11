<?php

namespace App\Filament\Admin\Resources\Blog\AuthorResource\Pages;

use Filament\Resources\Pages\EditRecord;
use App\Filament\Admin\Resources\Blog\AuthorResource;

class EditAuthor extends EditRecord
{
    protected static string $resource = AuthorResource::class;
}
