<?php

namespace Tests\Feature\Address;

use App\Models\User;
use Tests\Feature\FeatureBase;

class AddressUpdateTest extends FeatureBase
{
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

    public function test_user_is_not_authorized_to_update_address()
    {
        $addressData = [
            "street_address" => "street address name",
            "city" => "city name",
            "state" => "state name",
            "postal_code" => "postal code",
            "country" => "Brazil"
        ];

        $responseAddress = $this->actingAsUser()->postJson('/api/users/me/adresses', $addressData);
        $address_id = $responseAddress->json('data.id');

        $user = User::factory()->create([
            'name' => 'Example name 2',
            'email' => 'email2@example.com',
            'password' => 'examplepassword123'
        ]);

        $updateData = [
            'street_address' => 'example street address',
            'country' => 'Japan'
        ];

        $response = $this->actingAs($user)->putJson('/api/users/me/adresses/' . $address_id, $updateData);

        $response->assertStatus(403)
            ->assertJson([
                'success' => false,
                'message' => 'Permission denied to update address.',
            ]);
    }
}
