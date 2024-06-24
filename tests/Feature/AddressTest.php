<?php

namespace Tests\Feature;

use App\Models\User;

class AddressTest extends FeatureBase
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
