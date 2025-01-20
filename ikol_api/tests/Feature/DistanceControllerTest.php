<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DistanceControllerTest extends TestCase
{
    public function test_calculate_distance_with_valid_coordinates(): void
    {
        $payload = [
            'pointA' => [
                'latitude' => 52.20750826666523,
                'longitude' => 20.914993759613797,
            ],
            'pointB' => [
                'latitude' => 12.6464598156966,
                'longitude' => -8.0015034558936,
            ]
        ];

        $response = $this->postJson('/api/calculate-distance', $payload);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'distance' => [
                        'meters',
                        'kilometers'
                    ],
                    'points' => [
                        'pointA' => ['latitude', 'longitude'],
                        'pointB' => ['latitude', 'longitude']
                    ]
                ]
            ])
            ->assertJson([
                'status' => 'success'
            ]);

        // Verify that the distance calculations are numeric
        $this->assertIsFloat($response->json('data.distance.meters'));
        $this->assertIsFloat($response->json('data.distance.kilometers'));
    }

    public function test_calculate_distance_with_same_point(): void
    {
        $payload = [
            'pointA' => [
                'latitude' => 52.20750826666523,
                'longitude' => 20.914993759613797,
            ],
            'pointB' => [
                'latitude' => 52.20750826666523,
                'longitude' => 20.914993759613797,
            ]
        ];

        $response = $this->postJson('/api/calculate-distance', $payload);

        $response
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'data' => [
                    'distance' => [
                        'meters' => 0,
                        'kilometers' => 0
                    ]
                ]
            ]);
    }

    public function test_calculate_distance_with_invalid_data(): void
    {
        $payload = [
            'pointA' => [
                'latitude' => 'invalid',
                'longitude' => 20.914993759613797,
            ],
            'pointB' => [
                'latitude' => 12.6464598156966,
                'longitude' => -8.0015034558936,
            ]
        ];

        $response = $this->postJson('/api/calculate-distance', $payload);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['pointA.latitude']);
    }

    public function test_calculate_distance_with_missing_data(): void
    {
        $payload = [
            'pointA' => [
                'latitude' => 52.20750826666523,
                // missing longitude
            ],
            'pointB' => [
                'latitude' => 12.6464598156966,
                'longitude' => -8.0015034558936,
            ]
        ];

        $response = $this->postJson('/api/calculate-distance', $payload);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['pointA.longitude']);
    }

    public function test_calculate_distance_with_out_of_range_coordinates(): void
    {
        $payload = [
            'pointA' => [
                'latitude' => 92.20750826666523, // latitude can't be > 90
                'longitude' => 20.914993759613797,
            ],
            'pointB' => [
                'latitude' => 12.6464598156966,
                'longitude' => -8.0015034558936,
            ]
        ];

        $response = $this->postJson('/api/calculate-distance', $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['pointA.latitude'])
            ->assertJson([
                'message' => 'The point a.latitude field must be between -90 and 90.',
            ]);
    }
}