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


    public function getTableQuery(): Builder
    {
        return TestBooking::query()->where('customer_email', auth()->user()->email);
    }

    protected function getTableColumns(): array
    {
        return [
            BadgeColumn::make('status')
                ->label('Booking status')->sortable(),
            TextColumn::make('reference')->sortable(),
            TextColumn::make('testType.name')->wrap(),
            TextColumn::make('due_date')
                ->label('Booked for')
                ->date()
            ->sortable(),
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
