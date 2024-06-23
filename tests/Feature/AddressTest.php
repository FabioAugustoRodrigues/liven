<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

class AddressTest extends FeatureBase
{
    use RefreshDatabase;

    public function test_create_address()
    {
        $addressData = [
            "street_address" => "street address name",
            "city" => "city name",
            "state" => "state name",
            "postal_code" => "postal code",
            "country" => "Brazil"
        ];

        $response = $this->actingAsUser()->postJson('/api/users/me/adresses', $addressData);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'Address created successfully!',
            ]);
    }
}
