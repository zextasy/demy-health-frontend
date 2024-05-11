<?php

namespace App\Filament\Admin\Resources\TaskResource\Pages;

use Filament\Forms\Components\Textarea;
use App\Filament\Admin\Resources\TaskResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\DateTimePicker;

class EditTask extends EditRecord
{
    protected static string $resource = TaskResource::class;

    protected function getHeaderActions(): array
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
//			DateTimePicker::make('due_at')
//				->required(),
		];
	}
}
