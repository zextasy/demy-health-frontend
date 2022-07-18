<?php

namespace App\Http\Livewire\Forms;

use App\Models\TestType;
use App\Models\TestCategory;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Contracts\Foundation\Application;

class BookATestForCovid extends BookATest
{
    use LivewireAlert;

    public ?int $selectedTestCategory = null;
    public array|Collection $testCategories;
    public Collection $testTypes;


    public function mount()
    {
        $this->testCategories = TestCategory::query()->where('name', 'like', '%COVID%')->get();
        $this->testTypes = collect();
        $this->customerEmail = $this->getSessionCustomerEmail();
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
