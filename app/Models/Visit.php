<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Settings\GeneralSettings;
use App\Traits\Models\HasFilamentUrl;
use App\Traits\Models\GeneratesReference;
use App\Filament\Resources\VisitResource;
use App\Traits\Relationships\BelongsToBusinessGroup;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visit extends BaseModel
{
    use HasFactory;
    use GeneratesReference;
    use HasFilamentUrl;
    use BelongsToBusinessGroup;

//region CONFIG
    protected $guarded = ['id'];

    public function referenceConfig(): array
    {
        return [
            'reference_key' => 'reference',
            'reference_prefix' => app(GeneralSettings::class)->default_prefix,//TODO Change to visit_prefix
        ];
    }

    public function getFilamentResourceClass(): string
    {
        return VisitResource::class;
    }
//endregion

//region ATTRIBUTES

//endregion

//region HELPERS

//endregion

//region SCOPES

//endregion

//region RELATIONSHIPS
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
//endregion
}
