<?php

namespace App\Models;

use App\Helpers\HerokuHelper;
use Spatie\MediaLibrary\HasMedia;
use App\Settings\GeneralSettings;
use App\Contracts\OrderableItemContract;
use App\Traits\Models\GeneratesReference;
use App\Traits\Relationships\MorphsPrices;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\Relationships\MorphsOrderItems;
use App\Traits\Relationships\BelongsToBusinessGroup;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends BaseModel implements HasMedia, OrderableItemContract
{
    use HasFactory, InteractsWithMedia, MorphsOrderItems, GeneratesReference, MorphsPrices, BelongsToBusinessGroup;
    //region CONFIG
    public function referenceConfig(): array
    {
        return [
            'reference_key' => 'sku',
            'reference_prefix' => app(GeneralSettings::class)->product_sku_prefix,
        ];
    }
    protected $dates = ['created_at', 'updated_at'];
    protected $guarded = ['id'];
    protected $casts = [
        'extra_information' => 'array',
        'should_call_in_for_details' => 'boolean',
    ];
//    protected $with = ['prices','currentPrice'];
    //endregion

    //region ATTRIBUTES

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
    //endregion

    //region HELPERS

    //endregion

    //region SCOPES

    //endregion

    //region RELATIONSHIPS
    public function productCategories(): BelongsToMany
    {
        return $this->belongsToMany(ProductCategory::class, 'products_product_categories');
    }

    public function pictures()
    {
        return $this->media()->where('collection_name', 'pictures');
    }
    //endregion
}
