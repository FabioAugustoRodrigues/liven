<?php

namespace Tests\Feature\Address;

use App\Models\User;
use Tests\Feature\FeatureBase;

class AddressDeleteTest extends FeatureBase
{
    public function test_delete_address()
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

        $responseDelete = $this->actingAsExistingUser()->deleteJson('/api/users/me/adresses/' . $address_id);

        $responseDelete->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Address deleted successfully!',
            ]);
    }

    public function test_user_is_not_authorized_to_delete_address()
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

        $response = $this->actingAs($user)->deleteJson('/api/users/me/adresses/' . $address_id);

        $response->assertStatus(403)
            ->assertJson([
                'success' => false,
                'message' => 'Permission denied to delete address.',
            ]);
    }
}
