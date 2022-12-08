<?php

namespace App\Models;

use App\Support\BaseCollection;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use SoftDeletes;
    use LogsActivity;
    //region CONFIG

    //endregion

    //region ATTRIBUTES

    //endregion

    //region HELPERS

    //endregion

    //region SCOPES

    //endregion

    //region RELATIONSHIPS

    //endregion
    public function newCollection(array $models = []): BaseCollection
    {
        return new BaseCollection($models);
    }

    public function toLivewireSelectDescription($description = 'name', $value = 'id'): array
    {
        return [
            'value' => $this->getAttribute($value),
            'description' => $this->getAttribute($description),
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll()->dontSubmitEmptyLogs();
    }
}
