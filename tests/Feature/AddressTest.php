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

    public function test_get_all_adresses_by_user()
    {
        $response = $this->actingAsUser()->getJson('/api/users/me/adresses');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Adresses retrieved successfully!',
            ]);
    }

    public function test_update_address()
    {
        $addressData = [
            "street_address" => "street address name",
            "city" => "city name",
            "state" => "state name",
            "postal_code" => "postal code",
            "country" => "Brazil"
        ];

        $response = $this->actingAsUser()->postJson('/api/users/me/adresses', $addressData);

        $id = $response->json('data.id');

        $updateData = [
            'street_address' => 'example street address',
            'country' => 'Japan'
        ];

        $response = $this->actingAsExistingUser()->putJson('/api/users/me/adresses/' . $id, $updateData);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Address updated successfully!',
            ]);
    }
}
