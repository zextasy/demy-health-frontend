<?php

namespace App\Filament\Resources\Blog\PostResource\Pages;

use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\Blog\PostResource;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;
}
