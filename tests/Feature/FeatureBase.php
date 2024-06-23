<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeatureBase extends TestCase
{
    use RefreshDatabase;

    protected function actingAsUser()
    {
        $user = User::factory()->create([
            'name' => 'Example name',
            'email' => 'email@example.com',
            'password' => 'examplepassword123'
        ]);

        return $this->actingAs($user);
    }

    protected function actingAsExistingUser()
    {
        $user = User::where('email', 'email@example.com')->firstOrFail();

        return $this->actingAs($user);
    }
}
