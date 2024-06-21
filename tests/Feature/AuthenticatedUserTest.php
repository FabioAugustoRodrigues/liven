<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticatedUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_data_retrieval()
    {
        $user = User::factory()->create([
            'name' => 'Example name',
            'email' => 'email@example.com',
            'password' => 'examplepassword123'
        ]);
    
        $credentials = [
            'email' => 'email@example.com',
            'password' => 'examplepassword123',
        ];

        $response = $this->postJson('/api/users/login', $credentials);

        $token = $response->json('data.access_token');

        $meResponse = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->getJson('/api/users/me');

        $meResponse->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'User data retrieved successfully',
            ]);
    }

    public function test_unauthenticated_user_data_retrieval()
    {
        $response = $this->getJson('/api/users/me');

        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthenticated.',
            ]);
    }

    public function test_authenticated_user_update()
    {
        $user = User::factory()->create([
            'name' => 'Example name',
            'email' => 'email@example.com',
            'password' => 'examplepassword123'
        ]);

        $credentials = [
            'email' => 'email@example.com',
            'password' => 'examplepassword123',
        ];

        $response = $this->postJson('/api/users/login', $credentials);

        $token = $response->json('data.access_token');

        $updateData = [
            'name' => 'Neww example name'
        ];

        $updateResponse = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->putJson('/api/users/me', $updateData);

        $updateResponse->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'User updated successfully!',
            ]);
    }
}
