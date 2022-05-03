<?php

namespace App\Http\Livewire\Forms\Select\LivewireSelect;


use App\Models\State;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\LocalGovernmentArea;
use Asantibanez\LivewireSelect\LivewireSelect;

class LocalGovernmentAreaSelect extends LivewireSelect
{
    public function options($searchTerm = null): Collection
    {
        return LocalGovernmentArea::query()
            ->when($this->hasDependency('selectedState'), function ($query) {
                $query->where('state_id', $this->getDependingValue('selectedState'));
            })
            ->when($searchTerm, function ($query, $searchTerm) {
                $query->where(DB::raw('LOWER(name)'), 'like', '%'. strtolower($searchTerm) .'%');
            })
            ->get()
            ->toLivewireSelectCollection();
    }

    public function selectedOption($value): array
    {
        $model = LocalGovernmentArea::find($value);

        return optional($model)->toLivewireSelectDescription();
    }
}
