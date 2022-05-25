<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\Relationships\MorphsSocialMediaLinks;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeamMember extends BaseModel implements HasMedia
{
    use HasFactory, MorphsSocialMediaLinks, InteractsWithMedia;

    protected $dates = ['created_at', 'updated_at'];
    protected $guarded = ['id'];


}
