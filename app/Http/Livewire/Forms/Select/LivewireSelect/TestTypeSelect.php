<?php

namespace App\Http\Livewire\Forms\Select\LivewireSelect;


use App\Models\TestType;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Asantibanez\LivewireSelect\LivewireSelect;

class TestTypeSelect extends LivewireSelect
{
    public function options($searchTerm = null) : Collection
    {
        return TestType::query()
            ->when($this->hasDependency('test_category_id'), function ($query) {
                $query->where('test_category_id', $this->getDependingValue('test_category_id'));
            })
            ->when($searchTerm, function ($query, $searchTerm) {
                $query->where(DB::raw('LOWER(name)'), 'like', '%'. strtolower($searchTerm) .'%');
            })
            ->get()
            ->toLivewireSelectCollection('name');
    }

    public function selectedOption($value)
    {
        $model = TestType::find($value);

        return optional($model)->toLivewireSelectDescription('description');
    }
}
