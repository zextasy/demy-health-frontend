<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductCategory extends Model
{
    use HasFactory;

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'products_product_categories');
    }
}
