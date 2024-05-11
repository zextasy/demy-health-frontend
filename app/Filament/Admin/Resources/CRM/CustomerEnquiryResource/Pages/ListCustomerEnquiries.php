<?php

namespace App\Filament\Admin\Resources\CRM\CustomerEnquiryResource\Pages;

use App\Filament\Admin\Resources\CRM\CustomerEnquiryResource;
use Filament\Resources\Pages\ListRecords;

class ListCustomerEnquiries extends ListRecords
{
    protected static string $resource = CustomerEnquiryResource::class;
}
