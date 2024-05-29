<?php

namespace App\Livewire\Forms\Select\LivewireSelect;

use App\Models\Country;
use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CountrySelect extends LivewireSelect
{
    public function options($searchTerm = null): Collection
    {
        return Country::query()
            ->when($searchTerm, function ($query, $searchTerm) {
                $query->where(DB::raw('LOWER(name)'), 'like', '%'.strtolower($searchTerm).'%');
            })
            ->get()
            ->toLivewireSelectCollection();
    }

    public function selectedOption($value)
    {
        $model = Country::find($value);

        return optional($model)->toLivewireSelectDescription();
    }
}
