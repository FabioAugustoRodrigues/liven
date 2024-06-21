<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticatedUserTest extends FeatureBase
{
    use RefreshDatabase;

    public function test_authenticated_user_data_retrieval()
    {
        $response = $this->actingAsUser()->getJson('/api/users/me');

        $response->assertStatus(200)
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
        $updateData = [
            'name' => 'New example name'
        ];

        $response = $this->actingAsUser()->putJson('/api/users/me', $updateData);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'User updated successfully!',
            ]);
    }

    public function test_authenticated_user_delete()
    {
        $response = $this->actingAsUser()->deleteJson('/api/users/me');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'User deleted successfully!',
            ]);
    }
}
