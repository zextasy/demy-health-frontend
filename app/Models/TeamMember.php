<?php

namespace App\Models;

use App\Traits\Relationships\HasSocialMediaLinks;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory, HasSocialMediaLinks;

    protected $dates =['created_at','updated_at'];
    protected $guarded = ['id'];
}
