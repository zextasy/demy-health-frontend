<?php

namespace App\Traits\Enums;

use Illuminate\Support\Str;
use App\Helpers\StringHelper;

trait HasDefaultFilamentLabels
{
    public function getLabel(): ?string
    {
        return Str::of($this->name)->replace('_',' ')->title();
    }
}
