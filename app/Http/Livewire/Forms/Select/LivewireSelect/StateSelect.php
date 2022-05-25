<?php

namespace App\Http\Livewire\Forms\Select\LivewireSelect;


use App\Models\State;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Asantibanez\LivewireSelect\LivewireSelect;

class StateSelect extends LivewireSelect
{
    public bool $isForSample = false;
    public bool $isForTestCenter = false;

    public function options($searchTerm = null): Collection
    {
        return State::query()
            ->when($this->isForSample, function ($query) {
                $query->where('is_ready_for_sample_collection', true);
            })
            ->when($this->isForTestCenter, function ($query) {
                $query->where('is_ready_for_sample_collection', true);
            })
            ->when($this->hasDependency('test_category_id'), function ($query) {
                $query->where('test_category_id', $this->getDependingValue('test_category_id'));
            })
            ->when($searchTerm, function ($query, $searchTerm) {
                $query->where(DB::raw('LOWER(name)'), 'like', '%'. strtolower($searchTerm) .'%');
            })
            ->get()
            ->toLivewireSelectCollection();
    }
}
