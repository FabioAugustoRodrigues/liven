<?php

namespace Tests\Feature\User;

use Tests\Feature\FeatureBase;

class UserUpdateTest extends FeatureBase
{
    public function test_user_can_update_own_information()
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
}
