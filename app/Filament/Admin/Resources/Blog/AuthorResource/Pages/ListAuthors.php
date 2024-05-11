<?php

namespace App\Filament\Admin\Resources\Blog\AuthorResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Admin\Resources\Blog\AuthorResource;

class ListAuthors extends ListRecords
{
    protected static string $resource = AuthorResource::class;
}
