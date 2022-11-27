<?php

namespace App\Traits\Models;

trait LaravelMorphable
{

    public function getLaravelMorphModelType(): string
    {
        return get_class($this);
    }

    public function getLaravelMorphModelId(): int
    {
        return $this->id;
    }
}
