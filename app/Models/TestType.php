<?php

namespace App\Models;

use App\Traits\Relationships\HasTestBookings;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestType extends BaseModel
{
    use HasFactory, HasTestBookings;

    protected $dates =['created_at','updated_at'];
    protected $guarded = ['id'];

    public function getTatAttribute(): string
    {
        if ($this->minimum_tat == $this->maximum_tat){
            return "{$this->maximum_tat} days";
        }

        return "{$this->minimum_tat} - {$this->maximum_tat} days";
    }
    public function category() : BelongsTo{
        return $this->belongsTo(TestCategory::class);
    }

    public function specimenTypes() : BelongsToMany{
        return $this->belongsToMany(SpecimenType::class,'specimen_types_test_types');
    }
}
