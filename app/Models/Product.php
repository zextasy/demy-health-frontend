<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends BaseModel implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $dates = ['created_at', 'updated_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'extra_information' => 'array',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(ProductCategory::class, 'products_product_categories');
    }
}
