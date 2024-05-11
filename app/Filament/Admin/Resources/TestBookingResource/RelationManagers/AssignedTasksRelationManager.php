<?php

namespace App\Filament\Admin\Resources\TestBookingResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\RelationManagers\BaseMorphManyTasksRelationManager;

class AssignedTasksRelationManager extends BaseMorphManyTasksRelationManager
{
    protected static string $relationship = 'assignedTasks';

    protected static ?string $title = 'Assigned Tasks';
}
