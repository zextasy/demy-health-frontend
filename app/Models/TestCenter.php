<?php

namespace App\Models;

use App\Traits\Models\HasFilamentUrl;
use App\Contracts\AddressableContract;
use App\Traits\Models\LaravelMorphable;
use App\Contracts\VisitableLocationContract;
use App\Filament\Resources\TestCenterResource;
use App\Traits\Relationships\BelongsToBusinessGroup;
use App\Traits\Relationships\HasTestBookings;
use App\Traits\Relationships\MorphsAddresses;
use App\Traits\Relationships\MorphsContactDetails;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestCenter extends BaseModel implements AddressableContract, VisitableLocationContract
{
    use HasFactory;
    use HasTestBookings;
    use MorphsAddresses;
    use MorphsContactDetails;
    use BelongsToBusinessGroup;
    use LaravelMorphable;
    use HasFilamentUrl;

    protected $dates = ['created_at', 'updated_at'];

    protected $guarded = ['id'];

    public function getFilamentResourceClass(): string
    {
        return TestCenterResource::class;
    }
}
