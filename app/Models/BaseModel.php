<?php

namespace App\Models;

use App\Support\BaseCollection;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    public function newCollection(array $models = []): BaseCollection
    {
        return new BaseCollection($models);
    }

    public function toLivewireSelectDescription($description = 'name',$value = 'id'): array
    {
        return [
            'value' => $this->getAttribute($value),
            'description' => $this->getAttribute($description),
        ];
    }
}
