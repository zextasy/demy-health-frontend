<?php

namespace App\Filament\Resources\Blog\PostResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\Blog\PostResource;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;
}
