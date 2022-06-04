<?php

namespace App\Http\Livewire\Forms\Select\LivewireSelect;


use App\Models\State;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\LocalGovernmentArea;
use Asantibanez\LivewireSelect\LivewireSelect;

class LocalGovernmentAreaSelect extends LivewireSelect
{
    public bool $isForSample = false;

    public function options($searchTerm = null): Collection
    {
        return LocalGovernmentArea::query()
            ->when($this->isForSample, function ($query) {
                $query->isReadyForSampleCollection();
            })
            ->when($this->hasDependency('selectedStateForHomeBooking'), function ($query) {
                $query->where('state_id', $this->getDependingValue('selectedStateForHomeBooking'));
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
