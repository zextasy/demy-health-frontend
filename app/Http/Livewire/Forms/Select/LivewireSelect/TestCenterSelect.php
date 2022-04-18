<?php

namespace App\Http\Livewire\Forms\Select\LivewireSelect;


use App\Models\State;
use App\Models\TestCenter;
use Illuminate\Support\Collection;
use Asantibanez\LivewireSelect\LivewireSelect;

class TestCenterSelect extends LivewireSelect
{

    public $testCenterId;



    public function options($searchTerm = null): Collection
    {
        return TestCenter::query()
            ->when($this->hasDependency('test_category_id'), function ($query) {
                $query->where('test_category_id', $this->getDependingValue('test_category_id'));
            })
            ->when($searchTerm, function ($query, $searchTerm) {
                $query->where('name', 'like', "%$searchTerm%");
            })
            ->get()
            ->toLivewireSelectCollection();
    }

    public function selectedOption($value): array
    {
        $model = TestCenter::find($value);

        return optional($model)->toLivewireSelectDescription();
    }

}
