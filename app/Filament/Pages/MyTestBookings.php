<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\TestBooking;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\LinkAction;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Concerns\InteractsWithTable;

class MyTestBookings extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Personal';
    protected static string $view = 'filament.pages.my-test-bookings';

    public $tableSortColumn ='created_at';
    public $tableSortDirection = 'desc';

    public function getTableQuery(): Builder
    {
        return TestBooking::query()->where('user_id', auth()->user()->id);
    }

    protected function getTableColumns(): array
    {
        return [
            BadgeColumn::make('status')
                ->label('Booking status'),
            TextColumn::make('reference'),
            TextColumn::make('testType.description')->wrap(),
            TextColumn::make('due_date')
                ->label('Booked for')
                ->date(),
            //            TextColumn::make('latestSpecimenSample.created_at')
            //                ->label('Sample collected on')
            //                ->date(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            LinkAction::make('View')
                ->url(fn(TestBooking $record): string => $record->filament_url)
                ->hidden(fn(TestBooking $record): bool => $record->user()->doesntExist()),
        ];
    }
}
