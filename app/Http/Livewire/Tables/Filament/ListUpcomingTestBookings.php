<?php

namespace App\Http\Livewire\Tables\Filament;

use Livewire\Component;
use App\Models\Patient;
use App\Models\TestBooking;
use Filament\Tables\Actions\Action;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\LinkAction;
use Illuminate\Support\Facades\Session;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Filament\Tables\Concerns\InteractsWithTable;
use App\Traits\Livewire\ManipulatesCustomerSession;

class ListUpcomingTestBookings extends Component implements HasTable
{
    use LivewireAlert, InteractsWithTable, ManipulatesCustomerSession;

    public $customerIdentifier = null;
    public $testBookingReference;
    public $patientId;

    protected $rules = [
        'customerEmail' => 'required|string',
        'testBookingReference' => 'exists:test_bookings,reference', //test_bookings,reference
    ];

    protected function getTableQuery(): Builder
    {
        return TestBooking::query()->with(['user','patient'])->where('due_date', '>=', now());//->where('patient_id', $this->patientId)
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
            //            TextColumn::make('latestSpecimenSample.created_at')
            //                ->label('Sample collected on')
            //                ->date(),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Action::make('view')
                ->url(fn (TestBooking $record): string => route('frontend.test-bookings.show', $record->id)),
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->customerIdentifier = $this->getSessionCustomerIdentifier();
//                $this->table->shouldRender(false);
    }

    public function render()
    {
        return view('livewire.tables.filament.list-upcoming-test-bookings');
    }

    public function getTestResults()
    {
        $this->validate();
        $this->setSessionCustomerIdentifier($this->customerIdentifier);
        $patient = Patient::query()->where('email', $this->customerIdentifier)->first();
//        $this->table->shouldRender(true);
//        $testBookings = TestBooking::query()->where('reference', $this->testBookingReference)->first();
//
//        if ($testBookings->customer_email != $this->customerIdentifier) {
//            $this->testBookingReference = null;
//            $this->alert('error', 'The email does not match booking reference');
//
//            return;
//        }
//
//        if ($testBookings instanceof TestBooking) {
//            $this->patientId = $testBookings->id;
//        }

    }
}
