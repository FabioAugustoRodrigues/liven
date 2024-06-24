<?php

namespace Tests\Feature\User;

use Tests\Feature\FeatureBase;

class UserDeleteTest extends FeatureBase
{
    public function test_user_can_delete_own_account()
    {
        $response = $this->actingAsUser()->deleteJson('/api/users/me');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'User deleted successfully!',
            ]);
    }
}
