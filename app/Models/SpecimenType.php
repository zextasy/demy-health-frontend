<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SpecimenType extends BaseModel
{
    use HasFactory;

    protected $dates =['created_at','updated_at'];
    protected $guarded = ['id'];

    public function testTypes() : BelongsToMany{
        return $this->belongsToMany(TestType::class,'specimen_types_test_types');
    }
}
