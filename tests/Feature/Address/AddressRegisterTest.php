<?php

namespace Tests\Feature\Address;

use Tests\Feature\FeatureBase;

class AddressRegisterTest extends FeatureBase
{
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
