<?php

namespace App\Filament\Resources\Blog\AuthorResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Blog\AuthorResource;

class ListAuthors extends ListRecords
{
    protected static string $resource = AuthorResource::class;
}
