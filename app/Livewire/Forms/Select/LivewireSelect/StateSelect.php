<?php

namespace App\Livewire\Forms\Select\LivewireSelect;

use App\Models\State;
use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class StateSelect extends LivewireSelect
{
    public bool $isForSample = false;

    public bool $isForTestCenter = false;

    public function options($searchTerm = null): Collection
    {
        return State::query()
            ->when($this->isForSample, function ($query) {
                $query->isReadyForSampleCollection();
            })
            ->when($this->isForTestCenter, function ($query) {
                $query->has('testCenters');
            })
            ->when($this->hasDependency('test_category_id'), function ($query) {
                $query->where('test_category_id', $this->getDependingValue('test_category_id'));
            })
            ->when($searchTerm, function ($query, $searchTerm) {
                $query->where(DB::raw('LOWER(name)'), 'like', '%'.strtolower($searchTerm).'%');
            })
            ->get()
            ->toLivewireSelectCollection();
    }

    public function selectedOption($value)
    {
        $model = State::find($value);

        return optional($model)->toLivewireSelectDescription();
    }
}
