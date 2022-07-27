<?php

namespace App\Http\Livewire\Tables\Filament;

use App\Models\Patient;
use App\Models\TestBooking;
use App\Traits\Livewire\ManipulatesCustomerSession;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ListUpcomingTestBookings extends Component implements HasTable
{
    use LivewireAlert, InteractsWithTable, ManipulatesCustomerSession;

    public Patient $patient;

    public function mount(Patient $patient)
    {
        $this->patient = $patient;
    }

    protected function getTableQuery(): Builder
    {
        return TestBooking::query()->with(['user', 'patient'])->where('due_date', '>=', now())->where('patient_id', $this->patient->id)->latest(); //
    }

    protected function getTableColumns(): array
    {
        return [
            BadgeColumn::make('status')
                ->label('Booking status'),
            TextColumn::make('reference'),
            TextColumn::make('testType.name')->wrap(),
            TextColumn::make('due_date')
                ->label('Booked for')
                ->date(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('view')
                ->url(fn (TestBooking $record): string => route('frontend.test-bookings.show', $record->id)),
        ];
    }

    public function render()
    {
        return view('livewire.tables.filament.list-upcoming-test-bookings');
    }
}
