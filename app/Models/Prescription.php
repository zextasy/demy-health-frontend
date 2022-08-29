<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Settings\GeneralSettings;
use App\Traits\Models\GeneratesReference;
use App\Traits\Relationships\BelongsToBusinessGroup;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prescription extends BaseModel
{
    use HasFactory, GeneratesReference,BelongsToBusinessGroup;

//region CONFIG
    protected $guarded = ['id'];

    public function referenceConfig(): array
    {
        return [
            'reference_key' => 'reference',
            'reference_prefix' => app(GeneralSettings::class)->prescription_prefix,
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
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
}
//endregion

}
