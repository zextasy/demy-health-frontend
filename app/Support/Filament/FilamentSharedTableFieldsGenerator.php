<?php

namespace App\Support\Filament;

use App\Models\Task;
use App\Enums\Tasks\TaskStatusEnum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class FilamentSharedTableFieldsGenerator
{

    public static function getTaskTable()
    {
        return [
            TextColumn::make('assignedBy.name'),
            TextColumn::make('assignedTo.name'),
            TextColumn::make('details'),
            TextColumn::make('assignable_name')
                ->label('Target')
                ->url(fn(Task $record): string => $record->assignable_url),
            TextColumn::make('actionable_name')
                ->label('Result')
                ->url(fn(Task $record): string => $record->actionable_url ?? '#'),
            TextColumn::make('due_at')
                ->dateTime(),
            BadgeColumn::make('status')
                ->colors([
                    'primary' => TaskStatusEnum::ONGOING->value,
                    'secondary' => TaskStatusEnum::PENDING->value,
                    'danger' => TaskStatusEnum::FAILED->value,
                    'warning' => TaskStatusEnum::UNDER_REVIEW->value,
                    'success' => TaskStatusEnum::COMPLETE->value,
                ]),
        ];
    }
}
