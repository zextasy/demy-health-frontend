<?php

namespace App\Filament\Admin\Resources\Blog\PostResource\Pages;

use Filament\Resources\Pages\EditRecord;
use App\Filament\Admin\Resources\Blog\PostResource;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;
}
