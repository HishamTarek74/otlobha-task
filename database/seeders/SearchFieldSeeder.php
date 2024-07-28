<?php

namespace Database\Seeders;

use App\Models\SearchField;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SearchFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SearchField::factory(10)->create();

    }
}
