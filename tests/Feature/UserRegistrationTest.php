<?php

namespace Tests\Feature;

class UserRegistrationTest extends FeatureBase
{
    public function test_user_can_register()
    {
        $userData = [
            'name' => 'Example name',
            'email' => 'email@example.com',
            'password' => 'examplepassword123'
        ];

        $response = $this->postJson('/api/users', $userData);

        $this->assertDatabaseHas('users', [
            'email' => 'email@example.com'
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'User created successfully!'
            ]);
    }

    public function test_duplicate_email_validation_error_when_registering_user()
    {
        $user1 = [
            'name' => 'User 1',
            'email' => 'user@example.com',
            'password' => 'examplepassword123'
        ];

        $this->postJson('/api/users', $user1);

        $user2 = [
            'name' => 'User 2',
            'email' => 'user@example.com',
            'password' => 'examplepassword123'
        ];

        $response = $this->postJson('/api/users', $user2);

        $response->assertStatus(409)
            ->assertJson([
                'success' => false,
                'data' => null,
                'message' => 'E-mail is already in use'
            ]);
    }
}
