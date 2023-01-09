<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Enums\FieldTypeEnum;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VirtualField>
 */
class VirtualFieldFactory extends Factory
{

    private array $optionsValuesArray;

    public function __construct($count = null, ?Collection $states = null, ?Collection $has = null, ?Collection $for = null, ?Collection $afterMaking = null, ?Collection $afterCreating = null, $connection = null, ?Collection $recycle = null)
    {
        parent::__construct($count, $states, $has, $for, $afterMaking, $afterCreating, $connection, $recycle);
        $this->optionsValuesArray = FieldTypeEnum::values();
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $selectedOption = $this->faker->randomElement($this->optionsValuesArray);
        $fieldTypeEnum = FieldTypeEnum::from($selectedOption);
        $name = $this->faker->unique()->word().' '.Str::lower($fieldTypeEnum->name);
        return [
            'name' => Str::snake($name),
            'label' => Str::title($name),
            'field_type' => $selectedOption,
        ];
    }

    public function withOptions()
    {
        $options = $this->faker->words(20);
        $count = $this->faker->randomDigitNotZero();
        return $this->state(function (array $attributes) use ($count, $options) {
            return [
                'options' => $this->faker->randomElements($options, $count),
            ];
        });
    }
}
