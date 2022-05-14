<?php

namespace App\Models;

use App\Helpers\HerokuHelper;
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
        'should_call_in_for_details' => 'boolean',
    ];

    public function getformattedPriceAttribute($value)
    {
        if ($this->should_call_in_for_details){
            return "Call In";
        }

        return number_format($this->price);
    }

    public function getLatestPictureUrlAttribute() : string
    {
        if (HerokuHelper::isRunningHeroku()){
            return asset("demyhealth/images/products/default-product-image.png");
        }
        if ($this->media->count() > 0){
            return $this->media->first()->getUrl();
        }
        return asset("demyhealth/images/products/default-product-image.png");
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(ProductCategory::class, 'products_product_categories');
    }

    public function pictures()
    {
        return $this->media()->where('collection_name', 'pictures');
    }
}
