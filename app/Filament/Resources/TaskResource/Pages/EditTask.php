<?php

namespace App\Filament\Resources\TaskResource\Pages;

use Filament\Forms\Components\Textarea;
use App\Filament\Resources\TaskResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\DateTimePicker;

class EditTask extends EditRecord
{
    protected static string $resource = TaskResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

	protected function getFormSchema(): array
	{
		return [
			Textarea::make('details')
				->required()
				->maxLength(65535),
			DateTimePicker::make('due_at')
				->required(),
		];
	}
}
