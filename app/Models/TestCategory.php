<?php

namespace App\Models;

use App\Traits\Relationships\BelongsToSelf;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TestCategory extends BaseModel
{
    use HasFactory;
    use BelongsToSelf;

    protected $dates = ['created_at', 'updated_at'];

    protected $guarded = ['id'];

    public function testTypes(): HasMany
    {
        return $this->hasMany(TestType::class);
    }

    protected function getLocalForeignKey(): string
    {
        return 'test_category_id';
    }
}
