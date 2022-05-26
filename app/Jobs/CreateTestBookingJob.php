<?php

namespace App\Jobs;

use App\Models\Address;
use App\Models\TestCenter;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use App\Enums\TestBooking\LocationTypeEnum;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Actions\Addresses\CreateAddressAction;
use App\Actions\TestBookings\CreateTestBookingAction;

class CreateTestBookingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $locationType;
    private Carbon $dueDate;
    private int $selectedTestCenter;
    private int $selectedTestType;
    private string $customerEmail;
    private Address $address;

    public function __construct(int $locationType, Carbon $dueDate, int $selectedTestCenter, int $selectedTestType, string $customerEmail, Address $address)
    {
        $this->locationType = $locationType;
        $this->dueDate = $dueDate;
        $this->selectedTestCenter = $selectedTestCenter;
        $this->selectedTestType = $selectedTestType;
        $this->customerEmail = $customerEmail;
        $this->address = $address;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $locationTypeEnum = LocationTypeEnum::from($this->locationType);
        $carbonDueDate = Carbon::make($this->dueDate);
        $testBooking = (new CreateTestBookingAction)
            ->atTestCenter($this->selectedTestCenter)
            ->run($this->selectedTestType, $this->customerEmail, $locationTypeEnum, $carbonDueDate);

        $address = match ($locationTypeEnum) {
            LocationTypeEnum::HOME => (new CreateAddressAction)->run($this->addressLine1, $this->addressLine2, $this->city, $this->selectedState, $this->selectedLocalGovernmentArea),
            LocationTypeEnum::CENTER => TestCenter::find($this->selectedTestCenter)->latest_address,
        };

        $address->TestBookings()->save($testBooking);

        return array($testBooking, $address);
    }
}
