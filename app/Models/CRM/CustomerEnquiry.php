<?php

namespace App\Models\CRM;

use App\Enums\CRM\CustomerEnquiries\EnquiryTypeEnum;
use App\Filament\Resources\CRM\CustomerEnquiryResource;
use App\Models\BaseModel;
use App\Traits\Relationships\BelongsToBusinessGroup;
use App\Traits\Relationships\MorphsAddresses;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerEnquiry extends BaseModel
{
    use HasFactory, MorphsAddresses, BelongsToBusinessGroup;

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
