<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestCategory extends BaseModel
{
    use HasFactory;

    protected $dates =['created_at','updated_at'];
    protected $guarded = ['id'];

    public function testTypes() : HasMany{
        return $this->hasMany(TestType::class);
    }
}
