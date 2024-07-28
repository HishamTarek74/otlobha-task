<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PropertyField>
 */
class PropertyFieldFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' =>Arr::random(['area' , 'rooms' , 'price']),
            'value' => rand(100,1000),
            'property_id' => Property::inRandomOrder()->first()->id,
        ];
    }
}
