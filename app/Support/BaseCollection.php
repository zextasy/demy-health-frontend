<?php

namespace App\Support;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Collection;

class BaseCollection extends Collection
{

    public function toSelectArray(string $text = 'name', string $value = 'id')
    {
        return $this->mapWithKeys(function ($item) use ($text, $value) {
            return [$item[$value] => $item[$text]];
        });
    }

    public function toLivewireSelectCollection(string $description = 'name', string $value = 'id')
    {
        return $this->map(function (BaseModel $model) use ($value, $description) {
            return [
                'value' => $model->getAttribute($value),
                'description' => $model->getAttribute($description),
            ];
        });
    }
}
