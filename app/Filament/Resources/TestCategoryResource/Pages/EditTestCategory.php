<?php

namespace App\Filament\Resources\TestCategoryResource\Pages;

use App\Filament\Resources\TestCategoryResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Pages\Actions;

class EditTestCategory extends EditRecord
{
    protected static string $resource = TestCategoryResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
