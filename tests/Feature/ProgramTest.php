<?php

// tests/Feature/ProgramTest.php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ProgramTest extends TestCase {
    use RefreshDatabase;

    public function test_can_create_program() {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->postJson('/api/programs', [
            'name' => 'HIV Program',
            'description' => 'HIV treatment and care',
        ]);

        $response->assertStatus(201)
                 ->assertJson(['name' => 'HIV Program']);
    }
}