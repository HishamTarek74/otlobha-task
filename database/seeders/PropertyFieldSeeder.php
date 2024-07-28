<?php

namespace Database\Seeders;

use App\Models\PropertyField;
use Illuminate\Database\Seeder;

class PropertyFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PropertyField::factory(30)->create();
    }
}
