<?php

namespace App\Filament\Resources\Blog\PostResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Blog\PostResource;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;
}
