<?php

namespace App\Actions\CRM\CustomerEnquiries;

use App\Enums\CRM\CustomerEnquiries\EnquiryTypeEnum;
use App\Models\CRM\CustomerEnquiry;

class CreateCustomerEnquiryAction
{
    private ?EnquiryTypeEnum $type = null;

    public function run(string $customerEmail, string $customerName, string $customerMessage, string $customerPhone = null): CustomerEnquiry
    {
        return CustomerEnquiry::create([
            'customer_email' => $customerEmail,
            'customer_name' => $customerName,
            'customer_phone' => $customerPhone,
            'customer_message' => $customerMessage,
            'type' => $this->type ?? null,
        ]);
    }

    public function forType(EnquiryTypeEnum $typeEnum): self
    {
        $this->type = $typeEnum;

        return $this;
    }
}
