<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Traits\Relationships\HasSocialMediaLinks;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeamMember extends BaseModel implements HasMedia
{
    use HasFactory, HasSocialMediaLinks, InteractsWithMedia;

    protected $dates = ['created_at', 'updated_at'];
    protected $guarded = ['id'];


}
