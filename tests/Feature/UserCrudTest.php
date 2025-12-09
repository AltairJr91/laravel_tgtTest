<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_user_requires_fields()
    {
      
        $resp = $this->postJson('/api/users',  []);
        $resp->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'cpf', 'password']);
    }

    public function test_store_user_success()
    {
        $payload = [
            'name' => 'Altair',
            'email' => 'altair@example.com',
            'cpf' => '12345678901',
            'phone' => '11999999999',
            'password' => 'secret',
        ];
        $resp = $this->postJson('/api/users', $payload);
        $resp->assertStatus(201)
            ->assertJsonFragment(['email' => 'altair@example.com']);
        $this->assertDatabaseHas('users', ['email' => 'altair@example.com']);
    }

    public function test_soft_delete_user()
    {
        $user = User::factory()->create();
        $resp = $this->deleteJson("/api/users/{$user->id}");
        $resp->assertStatus(200);
        $this->assertSoftDeleted('users', ['id' => $user->id]);
    }
}
