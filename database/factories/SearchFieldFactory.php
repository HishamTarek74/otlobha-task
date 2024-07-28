<?php

namespace Database\Factories;

use App\Models\SearchProfile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SearchField>
 */
class SearchFieldFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => Arr::random(['price' , 'area' , 'rooms']),
            'min_value' =>  rand(100,500),
            'max_value' =>  rand(600,1000),
            'search_profile_id' => SearchProfile::inRandomOrder()->first()->id,
        ];
    }
}
