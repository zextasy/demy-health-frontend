<?php

namespace App\Models\Finance;

use App\Models\BaseModel;
use App\Settings\GeneralSettings;
use App\Traits\Models\GeneratesReference;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends BaseModel
{
    use HasFactory;
    use GeneratesReference;

//region CONFIG
    protected $guarded = ['id'];
//endregion

//region ATTRIBUTES

//endregion

//region HELPERS
    public function referenceConfig(): array
    {
        return [
            'reference_key' => 'reference',
            'reference_prefix' => app(GeneralSettings::class)->default_prefix,
        ];
    }
//endregion

//region SCOPES

//endregion

//region RELATIONSHIPS

//endregion


}
