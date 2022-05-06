<?php

namespace App\Models\CRM;

use App\Models\BaseModel;
use App\Traits\Relationships\HasAddresses;
use App\Enums\CRM\CustomerEnquiry\StatusEnum;
use App\Enums\CRM\CustomerEnquiry\EnquiryTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Filament\Resources\CRM\CustomerEnquiryResource;

class CustomerEnquiry extends BaseModel
{
    use HasFactory, HasAddresses;

    protected $guarded = ['id'];

    protected $casts = [
        'type' => EnquiryTypeEnum::class,
        'status' => StatusEnum::class,
    ];

    public function getFilamentUrlAttribute():string
    {
        return CustomerEnquiryResource::getUrl('view', ['record' => $this->id]);
    }
}
