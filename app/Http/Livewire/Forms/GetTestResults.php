<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use App\Models\TestBooking;
use App\Enums\TestBooking\StatusEnum;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\LinkAction;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Filament\Tables\Concerns\InteractsWithTable;
use App\Filament\Resources\TestBookingResource\Pages\ViewTestBooking;

class GetTestResults extends Component implements HasTable
{
    use LivewireAlert, InteractsWithTable;

    public $customerEmail = null;
    public $testBookingReference;
    public $testBookingId;

    protected $rules = [
        'customerEmail' => 'required|email',
        'testBookingReference' => 'required|exists:test_bookings,reference', //test_bookings,reference
    ];

    protected function getTableQuery(): Builder
    {
        return TestBooking::query()->where('id', $this->testBookingId);
    }

    protected function getTableColumns(): array
    {
        return [
            BadgeColumn::make('status')
                ->label('Booking status')
                ->enum(StatusEnum::optionsAsSelectArray())->wrap(false),
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
                ->url(fn (TestBooking $record): string => $record->filament_url)
                ->hidden(fn (TestBooking $record): bool => $record->user()->doesntExist())
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount(){
//        $this->table->shouldRender(false);
    }

    public function render()
    {
        return view('livewire.forms.get-test-results');
    }

    public function getTestResults()
    {
        $this->validate();
        $testBooking = TestBooking::query()->where('reference',$this->testBookingReference)->first();

        if ($testBooking->customer_email != $this->customerEmail){
            $this->testBookingReference = null;
            $this->alert('error','The email does not match booking reference');
            return;
        }

        if ($testBooking instanceof TestBooking){
            $this->testBookingId = $testBooking->id;
        }

    }
}
