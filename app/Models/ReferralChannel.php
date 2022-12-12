<?php

namespace App\Models;

use App\Settings\GeneralSettings;
use App\Traits\Relationships\Discounter;
use App\Traits\Models\GeneratesReference;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReferralChannel extends BaseModel
{
    use HasFactory;
    use GeneratesReference;
    use Discounter;

    //region CONFIG
    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at'];

    public function referenceConfig(): array
    {
        return [
            'reference_key' => 'referral_code',
            'reference_prefix' => app(GeneralSettings::class)->referral_code_prefix,
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
