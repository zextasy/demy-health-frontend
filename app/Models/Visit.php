<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Settings\GeneralSettings;
use App\Traits\Models\HasFilamentUrl;
use App\Contracts\AssignableContract;
use App\Traits\Models\LaravelMorphable;
use App\Traits\Relationships\Assignable;
use App\Traits\Models\GeneratesReference;
use App\Filament\Admin\Resources\VisitResource;
use App\Traits\Relationships\BelongsToPatient;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Traits\Relationships\BelongsToBusinessGroup;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visit extends BaseModel implements AssignableContract
{
    use HasFactory;
    use GeneratesReference;
    use HasFilamentUrl;
    use BelongsToBusinessGroup;
	use BelongsToPatient;
	use Assignable;
	use LaravelMorphable;

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
	protected function name(): Attribute
	{
        $this->loadMissing('patient');
		return Attribute::make(
			get: fn ($value) => 'Visit - ' .$this->created_at->toDateString() . ' - ' . $this->patient->full_name,
		)->shouldCache();
	}
//endregion

//region HELPERS
	public function getAssignableName(): string
	{
		return $this->name;
	}
//endregion

//region SCOPES

//endregion

//region RELATIONSHIPS

	public function vitalSignsRecords(): HasMany
	{
		return $this->hasMany(VitalSignsRecord::class);
	}

	public function latestVitalSignsRecord(): HasOne
	{
		return $this->hasOne(VitalSignsRecord::class)->ofMany()->latest();
	}

	public function visitableLocation(): MorphTo
	{
		return $this->morphTo();
	}
//endregion
}
