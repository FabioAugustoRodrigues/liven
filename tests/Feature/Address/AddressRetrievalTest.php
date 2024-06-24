<?php

namespace Tests\Feature\Address;

use Tests\Feature\FeatureBase;

class AddressRetrievalTest extends FeatureBase
{
    public function test_get_all_adresses_by_user()
    {
        $response = $this->actingAsUser()->getJson('/api/users/me/adresses');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Adresses retrieved successfully!',
            ]);
    }

    public function test_get_address_by_id()
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

        $response = $this->actingAsExistingUser()->getJson('/api/users/me/adresses/' . $id);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Address retrieved successfully!',
            ]);
    }
}
