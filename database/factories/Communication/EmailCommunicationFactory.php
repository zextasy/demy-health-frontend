<?php

namespace Database\Factories\Communication;


use App\Models\Communication\EmailCommunication;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmailCommunication>
 */
class EmailCommunicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = EmailCommunication::class;
    public function definition()
    {
        return [
            //
        ];
    }
}
