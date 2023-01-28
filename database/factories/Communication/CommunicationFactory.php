<?php

namespace Database\Factories\Communication;

use App\Models\Communication\Communication;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Communication\Communication>
 */
class CommunicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Communication::class;
    public function definition()
    {
        return [
            //
        ];
    }
}
