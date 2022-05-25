<?php

namespace App\Models\CRM;

use App\Models\BaseModel;
use App\Traits\Relationships\MorphsAddresses;
use App\Enums\CRM\CustomerEnquiry\EnquiryTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Filament\Resources\CRM\CustomerEnquiryResource;

class CustomerEnquiry extends BaseModel
{
    use HasFactory, MorphsAddresses;

    protected $guarded = ['id'];

    protected $casts = [
        'type' => EnquiryTypeEnum::class,
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function getFilamentUrlAttribute(): string
    {
        return CustomerEnquiryResource::getUrl('view', ['record' => $this->id]);
    }
}
