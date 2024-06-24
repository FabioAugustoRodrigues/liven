<?php

namespace Tests\Feature\User;

use App\Models\User;
use Tests\Feature\FeatureBase;

class UserLoginTest extends FeatureBase
{
    public function test_successful_user_login()
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

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'User logged in successfully!',
            ]);
    }

    public function test_invalid_user_login()
    {
        $credentials = [
            'email' => 'emailthatnotexists@example.com',
            'password' => 'examplepassword123',
        ];

        $response = $this->postJson('/api/users/login', $credentials);

        $response->assertStatus(401)
            ->assertJson([
                'success' => false,
                'message' => 'Incorrect login or password.',
            ]);
    }
}
