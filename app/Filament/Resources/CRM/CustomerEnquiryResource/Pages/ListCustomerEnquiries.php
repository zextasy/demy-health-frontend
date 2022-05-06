<?php

namespace App\Filament\Resources\CRM\CustomerEnquiryResource\Pages;

use App\Filament\Resources\CRM\CustomerEnquiryResource;
use Filament\Resources\Pages\ListRecords;

class ListCustomerEnquiries extends ListRecords
{
    protected static string $resource = CustomerEnquiryResource::class;
}
