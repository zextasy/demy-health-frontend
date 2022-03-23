<?php

namespace App\Http\Livewire\Forms;

use Livewire\Component;
use App\Models\TestType;
use App\Models\TestCenter;
use App\Models\TestCategory;

class BookATest extends Component
{
    public $testCenters;
    public $testCategories;
    public $testTypes;

    public $selectedTestCategory = NULL;

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

    public function updatedSelectedTestCategory($testCategoryId)
    {
        if (!is_null($testCategoryId)) {
            $this->testTypes = TestType::where('test_category_id', $testCategoryId)->get();
        }
    }
}
