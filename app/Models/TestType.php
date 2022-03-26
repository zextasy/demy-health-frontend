<?php

namespace App\Models;

use App\Traits\Relationships\HasTestBookings;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestType extends Model
{
    use HasFactory, HasTestBookings;

    protected $dates =['created_at','updated_at'];
    protected $guarded = ['id'];
}
