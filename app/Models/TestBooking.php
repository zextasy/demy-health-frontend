<?php

namespace App\Models;

use PDO;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Traits\Relationships\HasAddresses;
use App\Enums\TestBooking\LocationTypeEnum;
use App\Filament\Resources\TestBookingResource;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class TestBooking extends BaseModel
{
    use HasFactory, HasAddresses;

    protected $dates =['created_at','updated_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'location_type' => LocationTypeEnum::class,
    ];

    public function getNextId()
    {
        switch(DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME)) {
            case 'mysql':
                $statement = DB::select("show table status like 'test_bookings'");
                return $statement[0]->Auto_increment;

            default:
                return floor(time() - 999999999);
        }
    }

    public function getFilamentUrlAttribute():string
    {
        return TestBookingResource::getUrl('view', ['record' => $this->id]);
    }

    public function toFullCalenderEventArray():array
    {
        return [
            'id' => $this->id,
            'title' => "{$this->testType->description} for {$this->customer_email}",
            'start' => Carbon::make($this->due_date)->setTimeFromTimeString($this->start_time),
            'url' => $this->filament_url,
        ];
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
