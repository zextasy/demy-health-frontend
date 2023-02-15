<?php

namespace App\Contracts;

use App\Models\Communication\Communication;

interface GeneratesCommunicationContract
{
    public function getCommunication(CommunicableContract $customer, array $templateMergeData): Communication;
}
