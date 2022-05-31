<?php

namespace App\Http\Livewire\Forms;

use App\Models\User;
use App\Models\State;
use Livewire\Component;
use App\Models\Address;
use App\Models\TestType;
use App\Models\TestCenter;
use App\Models\TestBooking;
use App\Models\TestCategory;
use Illuminate\Support\Carbon;
use App\Events\TestBookedEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Models\LocalGovernmentArea;
use App\Helpers\FlashMessageHelper;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use App\Enums\TestBooking\LocationTypeEnum;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Actions\Addresses\CreateAddressAction;
use App\Http\Requests\StoreTestBookingRequest;
use Illuminate\Contracts\Foundation\Application;
use App\Actions\TestBookings\CreateTestBookingAction;

class BookATestForCovid extends BookATest
{
    use LivewireAlert;

    public ?int $selectedTestCategory = null;
    public array|Collection $testCategories;
    public Collection $testTypes;


    public function mount()
    {
        $this->testCategories = TestCategory::query()->where('name','like','%COVID%')->get();
        $this->testTypes = collect();
        $this->customerEmail = optional(auth()->user())->email;
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.forms.book-a-test-for-covid');
    }

    public function updatedSelectedTestCategory($testCategoryId)
    {
        if (!is_null($testCategoryId)) {
            $this->testTypes = TestType::where('test_category_id', $testCategoryId)->get();
        }
    }

}
