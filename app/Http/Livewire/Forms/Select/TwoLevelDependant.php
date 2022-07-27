<?php

namespace App\Http\Livewire\Forms\Select;

use Livewire\Component;

class TwoLevelDependant extends Component
{
    public $firstLevelCollection;

    public $firstLevelModelName;

    public $secondLevelCollection;

    public $secondLevelModel;

    public $secondLevelPrimaryKey;

    public $selectedModel = null;

//    public function mount($firstLevelCollection, $firstLevelModelName, $secondLevelModel, $secondLevelModelName, $secondLevelPrimaryKey, $secondLevelModelKey)
//
//    {
//
//        $this->firstLevelCollection = $firstLevelCollection;
//        $this->secondLevelCollection = collect();
//        $this->secondLevelModelClassName = get_class($secondLevelModel);
//        $this->secondLevelPrimaryKey = $secondLevelPrimaryKey;
//
//    }

    public function render()
    {
        return view('livewire.forms.select.two-level-dependant');
    }

    public function updatedSecondLevel($firstLevelModelId)
    {
        if (! is_null($firstLevelModelId)) {
            $this->secondLevelCollection = get_class($this->secondLevelModel)::where($this->secondLevelPrimaryKey, $firstLevelModelId)->get();
        }
    }
}
