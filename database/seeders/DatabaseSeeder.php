<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PropertyTypeSeeder::class);
        $this->call(PropertySeeder::class);
        $this->call(SearchProfileSeeder::class);
        $this->call(SearchFieldSeeder::class);
        $this->call(PropertyFieldSeeder::class);

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
    }
}
