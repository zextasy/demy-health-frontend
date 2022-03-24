<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use App\Models\TestType;
use App\Models\TestCenter;
use App\Models\TestBooking;
use App\Models\TestCategory;

class BookATest extends Component
{
    public $testCenters;
    public $testCategories;
    public $testTypes;

    public $selectedTestCategory = NULL;
    public $testCenter = NULL;
    public $testType = NULL;
    public $customerIdentifier = NULL;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function mount()
    {
        $this->testCenters = TestCenter::all();
        $this->testCategories = TestCategory::all();
        $this->testTypes = collect();
    }

    public function render()
    {
        return view('livewire.forms.book-a-test');
    }

    public function submit()
    {
        $validatedData = $this->validate([
            'customerIdentifier' => 'required',
            'testCenter' => 'required',
            'testType' => 'required',

        ]);
//        ray($this);
//        TestBooking::create($validatedData);
        flash()->overlay('Your test has been booked.','success')->livewire($this);
//        return redirect()->to('/form');
    }

    public function updatedSelectedTestCategory($testCategoryId)
    {
        if (!is_null($testCategoryId)) {
            $this->testTypes = TestType::where('test_category_id', $testCategoryId)->get();
        }
    }
}
