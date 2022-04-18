<?php

namespace App\Models;

use App\Enums\SocialMediaLink\SiteEnum;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMediaLink extends BaseModel
{
    use HasFactory;

    protected $dates =['created_at','updated_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'site' => SiteEnum::class,
    ];

    public function linkable(): MorphTo
    {
        return $this->morphTo('linkable');
    }
}
