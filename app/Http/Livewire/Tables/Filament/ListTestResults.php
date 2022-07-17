<?php

namespace App\Http\Livewire\Tables\Filament;

use Livewire\Component;
use App\Models\TestResult;
use App\Models\TestBooking;
use Filament\Tables\Actions\Action;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\LinkAction;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Filament\Tables\Concerns\InteractsWithTable;

class ListTestResults extends Component implements HasTable
{
    use LivewireAlert, InteractsWithTable;

    public $customerIdentifier = null;
    public $testBookingReference;
    public $testBookingId;

    protected $rules = [
        'customerEmail' => 'required|email',
        'testBookingReference' => 'exists:test_bookings,reference', //test_bookings,reference
    ];

    protected function getTableQuery(): Builder
    {
        return TestResult::query()->with(['testBooking']);//->where('patient_id', $this->patientId)
    }

    protected function getTableColumns(): array
    {
        return [
            BadgeColumn::make('status')
                ->label('Booking status'),
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

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        //        $this->table->shouldRender(false);
    }

    public function render()
    {
        return view('livewire.tables.filament.list-test-results');
    }

    public function getTestResults()
    {
        $this->validate();
        $testBooking = TestBooking::query()->where('reference', $this->testBookingReference)->first();

        if ($testBooking->customer_email != $this->customerIdentifier) {
            $this->testBookingReference = null;
            $this->alert('error', 'The email does not match booking reference');

            return;
        }

        if ($testBooking instanceof TestBooking) {
            $this->testBookingId = $testBooking->id;
        }

    }
}
