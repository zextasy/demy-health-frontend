<?php

namespace App\Models;

use App\Settings\GeneralSettings;
use App\Contracts\ActionableContract;
use App\Contracts\AssignableContract;
use App\Traits\Models\HasFilamentUrl;
use App\Traits\Models\LaravelMorphable;
use App\Traits\Relationships\Actionable;
use App\Traits\Relationships\Assignable;
use App\Traits\Models\GeneratesReference;
use App\Filament\Resources\ConsultationResource;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Consultation extends BaseModel implements ActionableContract, AssignableContract
{
    use Actionable;
    use Assignable;
    use HasFilamentUrl;
    use LaravelMorphable;
    use GeneratesReference;
    use HasFactory;

//region CONFIG
    protected $guarded = ['id'];
    public function referenceConfig(): array
    {
        return [
            'reference_key' => 'reference',
            'reference_prefix' => app(GeneralSettings::class)->default_prefix,//TODO Change to consultation_prefix
        ];
    }

    public function getFilamentResourceClass(): string
    {
        return ConsultationResource::class;
    }
//endregion

//region ATTRIBUTES
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => 'Consultation - ' .$this->created_at->toDateString() . ' - ' . $this->reference,
        );
    }
//endregion

//region HELPERS
    public function getAssignableName(): string
    {
        return $this->name;
    }

    public function getActionableName(): string
    {
        return $this->name;
    }
//endregion

//region SCOPES

//endregion

//region RELATIONSHIPS

//endregion

}
