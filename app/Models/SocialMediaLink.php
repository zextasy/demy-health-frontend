<?php

namespace App\Models;

use App\Enums\SocialMediaLinks\SiteEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMediaLink extends Model
{
    use HasFactory;

    protected $casts = [
        'site' => SiteEnum::class,
    ];
}
