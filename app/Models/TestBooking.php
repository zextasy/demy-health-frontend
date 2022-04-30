<?php

namespace App\Models;

use App\Helpers\FilamentHelper;
use App\Traits\Relationships\HasAddress;
use App\Enums\TestBooking\LocationTypeEnum;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\TestBookingResource\Pages\ViewTestBooking;

class TestBooking extends BaseModel
{
    use HasFactory, HasAddress;

    protected $dates =['created_at','updated_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'location_type' => LocationTypeEnum::class,
    ];

    public function getFilamentUrlAttribute():string
    {
        return FilamentHelper::getResourceURL('test-bookings')."/{$this->id}";
    }

    public function testType():BelongsTo
    {
        return $this->belongsTo(TestType::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function testCenter():BelongsTo
    {
        return $this->belongsTo(TestCenter::class);
    }
}
