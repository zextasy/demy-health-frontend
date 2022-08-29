<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Settings\GeneralSettings;
use App\Traits\Models\GeneratesReference;
use App\Traits\Relationships\MorphsAddresses;
use App\Traits\Relationships\BelongsToBusinessGroup;
use App\Traits\Relationships\ReferencesUsersViaEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends BaseModel
{
    use HasFactory, GeneratesReference, MorphsAddresses, BelongsToBusinessGroup, ReferencesUsersViaEmail;

//region CONFIG
    protected $guarded = ['id'];

    public function referenceConfig(): array
    {
        return [
            'reference_key' => 'reference',
            'reference_prefix' => app(GeneralSettings::class)->doctor_prefix,
        ];
    }
//endregion

//region ATTRIBUTES

//endregion

//region HELPERS

//endregion

//region SCOPES

//endregion

//region RELATIONSHIPS

//endregion

}
