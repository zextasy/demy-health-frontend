<?php

namespace App\Livewire\Forms;

use App\Models\State;
use App\Models\Country;
use App\Models\TestCategory;
use App\Models\TestType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class BookATestForCovid extends BookATest
{
    use LivewireAlert;

    public ?int $selectedTestCategory = null;
    public array $testCategories = [];
    public $testTypes = [];
    public $countries = [];
    public $statesForHomeBooking = [];
    public $statesForCenterBooking = [];
    public function mount()
    {
        $this->testCategories = TestCategory::query()->where('name', 'like', '%COVID%')->pluck('name','id')->toArray();
        $this->testTypes = [];
        $this->countries = Country::all()->pluck('name','id')->toArray();
        $this->statesForHomeBooking = State::query()->isReadyForSampleCollection()->pluck('name','id')->toArray();
        $this->statesForCenterBooking = State::query()->has('testCenters')->pluck('name','id')->toArray();
        $this->customerEmail = $this->getSessionCustomerEmail();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.forms.book-a-test-for-covid');
    }

    public function hydrate()
    {
        if (! is_null($this->selectedTestCategory)) {
            $this->testTypes = TestType::where('test_category_id', $this->selectedTestCategory)->get();
        }
    }
}
