<?php

namespace App\Filament\Admin\Resources\Blog\PostResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Admin\Resources\Blog\PostResource;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;
}
