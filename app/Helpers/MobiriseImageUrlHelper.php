<?php

namespace App\Helpers;

class MobiriseImageUrlHelper
{
    public string $equipmentUrl = 'assets/images/mbr-816x540.jpg';
    public string $reagentUrl = 'assets/images/mbr-816x540.jpg';

    public function getDefaultImageUrl():string
    {
        return 'assets/images/mbr-816x540.jpg';
    }

    public function getDefaultEquipmentImageUrl():string
    {
        return $this->equipmentUrl;
    }

    public function getDefaultReagentImageUrl():string
    {
        return $this->reagentUrl;
    }
}
