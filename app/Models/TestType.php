<?php

namespace App\Models;

use App\Filament\Resources\TestTypeResource;
use App\Settings\GeneralSettings;
use App\Traits\Models\GeneratesReference;
use App\Traits\Models\HasFilamentUrl;
use App\Traits\Relationships\HasTestBookings;
use App\Traits\Relationships\MorphsPrices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TestType extends BaseModel
{
    use HasFactory, HasTestBookings, MorphsPrices, HasFilamentUrl, GeneratesReference;

    protected $dates = ['created_at', 'updated_at'];

    protected $guarded = ['id'];

    protected $casts = [
        'should_call_in_for_details' => 'boolean',
    ];

    public function referenceConfig(): array
    {
        return [
            'reference_key' => 'test_id',
            'reference_prefix' => app(GeneralSettings::class)->test_type_prefix,
        ];
    }

    public function getFilamentResourceClass(): string
    {
        return TestTypeResource::class;
    }

    public function getTatAttribute(): string
    {
        if ($this->should_call_in_for_details) {
            return 'Call In';
        }

        if ($this->minimum_tat == 0 && $this->maximum_tat == 0) {
            return "{$this->tat_hours} hours";
        }

        return $this->minimum_tat == $this->maximum_tat ? "{$this->maximum_tat} days" : "{$this->minimum_tat} - {$this->maximum_tat} days";
    }

    public function getFilamentUrlAttribute(): string
    {
        return TestTypeResource::getUrl('view', ['record' => $this->id]);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(TestCategory::class, 'test_category_id');
    }

    public function specimenTypes(): BelongsToMany
    {
        return $this->belongsToMany(SpecimenType::class, 'specimen_types_test_types');
    }
}
