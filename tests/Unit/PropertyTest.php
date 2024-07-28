<?php

namespace Tests\Unit;

use App\Http\Controllers\PropertyController;
use App\Models\Property;
use App\Models\PropertyField;
use App\Models\PropertyType;
use App\Models\SearchProfile;
use App\Models\SearchField;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PropertyTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testMatch()
    {
        $propertyType = PropertyType::factory()->create();
        // Create a property
        $property = Property::factory()->create([
            'name' => 'Property1',
            'address' => '12 main st',
            'property_type_id' => $propertyType->id
        ]);

        // Add fields to the property
        PropertyField::factory()->create([
            'property_id' => $property->id,
            'name' => 'price',
            'value' => 150000
        ]);

        PropertyField::factory()->create([
            'property_id' => $property->id,
            'name' => 'area',
            'value' => 100
        ]);

        // Create search profiles
        $searchProfile1 = SearchProfile::factory()->create([
            'name' => 'profile 1',
            'property_type_id' => 1
        ]);

        $searchProfile2 = SearchProfile::factory()->create([
            'name' => 'profile 2',
            'property_type_id' => 1
        ]);

        // Add fields to search profiles
        SearchField::factory()->create([
            'search_profile_id' => $searchProfile1->id,
            'name' => 'price',
            'min_value' => 100000,
            'max_value' => 200000
        ]);

        SearchField::factory()->create([
            'search_profile_id' => $searchProfile1->id,
            'name' => 'area',
            'min_value' => 80,
            'max_value' => 120
        ]);

        SearchField::factory()->create([
            'search_profile_id' => $searchProfile2->id,
            'name' => 'price',
            'min_value' => 160000,
            'max_value' => 250000
        ]);

        // Call the match method
        $response = $this->getJson('/api/v1/match/' . $property->id);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['searchProfileId', 'score', 'strictMatchesCount', 'looseMatchesCount']
                ]
            ])
            ->assertJson([
                'data' => [
                    [
                        'searchProfileId' => $searchProfile1->id,
                        'score' => 1.0,
                        'strictMatchesCount' => 2,
                        'looseMatchesCount' => 0
                    ]
                ]
            ]);
    }
}
