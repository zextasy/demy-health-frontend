<?php

namespace App\Actions\CRM\CustomerEnquiries;

use App\Models\CRM\CustomerEnquiry;
use App\Enums\CRM\CustomerEnquiries\EnquiryTypeEnum;

class CreateCustomerEnquiryAction
{
    private ?EnquiryTypeEnum $type = null;

    public function run(string $customerEmail, string $customerName, string $customerMessage, string $customerPhone = null) : CustomerEnquiry
    {
        return CustomerEnquiry::create([
            'customer_email' => $customerEmail,
            'customer_name' => $customerName,
            'customer_phone' => $customerPhone,
            'customer_message' => $customerMessage,
            'type' => $this->type ?? null,
        ]);
    }

    public function forType(EnquiryTypeEnum $typeEnum) : CreateCustomerEnquiryAction {
        $this->type = $typeEnum;
        return $this;
    }

}
