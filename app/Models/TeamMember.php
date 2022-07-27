<?php

namespace App\Models;

use App\Traits\Relationships\BelongsToBusinessGroup;
use App\Traits\Relationships\MorphsSocialMediaLinks;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class TeamMember extends BaseModel implements HasMedia
{
    use HasFactory, MorphsSocialMediaLinks, InteractsWithMedia, BelongsToBusinessGroup;

    protected $dates = ['created_at', 'updated_at'];

    protected $guarded = ['id'];
}
