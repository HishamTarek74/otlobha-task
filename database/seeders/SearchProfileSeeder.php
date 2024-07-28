<?php

namespace Database\Seeders;

use App\Models\SearchField;
use App\Models\SearchProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SearchProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SearchProfile::factory(50)->has(SearchField::factory(5),'fields')->create();
    }
}
