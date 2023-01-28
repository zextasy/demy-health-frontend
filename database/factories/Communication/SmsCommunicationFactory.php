<?php

namespace Database\Factories\Communication;


use App\Models\Communication\SmsCommunication;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SmsCommunication>
 */
class SmsCommunicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = SmsCommunication::class;

    public function definition()
    {
        return [
            //
        ];
    }
}
