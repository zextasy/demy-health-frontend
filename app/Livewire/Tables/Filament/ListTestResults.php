<?php

namespace App\Livewire\Tables\Filament;

use App\Models\TestBooking;
use App\Models\TestResult;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Traits\Livewire\ManipulatesCustomerSession;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ListTestResults extends Component implements HasTable
{
    use LivewireAlert;
    use InteractsWithTable;
    use InteractsWithForms;
    use ManipulatesCustomerSession;

    public TestBooking $testBooking;

    protected function getTableQuery(): Builder
    {
        return TestResult::query()->with(['testBooking']); //->where('patient_id', $this->patientId)
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('status')
                ->label('Booking status')->badge(),
            TextColumn::make('reference'),
            TextColumn::make('testBooking.testType.name')->wrap(),
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
            Action::make('view')
                ->url(fn (TestResult $record): string => route('frontend.test-results.show', $record->id)),
        ];
    }

    public function render()
    {
        return view('livewire.tables.filament.list-test-results');
    }
}
