<?php

namespace Tests\Feature\User;

use Tests\Feature\FeatureBase;

class UserRetrievalTest extends FeatureBase
{
    public function test_user_can_retrieve_own_data()
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

}
