<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends FeatureBase
{
    use RefreshDatabase;

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
            ->assertJsonStructure([
                'success',
                'data' => [
                    'access_token',
                    'token_type',
                    'expires_in',
                ],
                'message',
            ])
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

        $this->postJson('/api/users/login', $credentials)
            ->assertStatus(401)
            ->assertJson([
                'success' => false,
                'message' => 'Incorrect login or password.',
            ]);
    }
}
