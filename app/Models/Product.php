<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'extra_information' => 'array'
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(ProductCategory::class, 'products_product_categories');
    }
}
