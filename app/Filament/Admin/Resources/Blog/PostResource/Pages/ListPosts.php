<?php

namespace App\Filament\Admin\Resources\Blog\PostResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Admin\Resources\Blog\PostResource;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;
}
