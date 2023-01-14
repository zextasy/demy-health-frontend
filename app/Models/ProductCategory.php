<?php

namespace App\Models;

use App\Traits\Relationships\BelongsToSelf;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductCategory extends BaseModel
{
    use HasFactory;
    use BelongsToSelf;

    protected $dates = ['created_at', 'updated_at'];

    protected $guarded = ['id'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'products_product_categories');
    }


    protected function getLocalForeignKey(): string
    {
        return 'product_category_id';
    }
}
