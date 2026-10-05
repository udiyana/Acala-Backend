<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CmsAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_returns_current_csrf_token_after_session_regeneration(): void
    {
        User::factory()->create([
            'email' => 'admin@acala.id',
            'password' => Hash::make('secret123'),
        ]);

        $this->withSession(['_token' => 'stale-token']);

        $response = $this->postJson('/api/cms/login', [
            'email' => 'admin@acala.id',
            'password' => 'secret123',
        ]);

        $response
            ->assertOk()
            ->assertHeader('X-CSRF-TOKEN')
            ->assertJsonStructure([
                'csrf_token',
                'user' => ['id', 'name', 'email'],
            ]);

        $freshToken = $response->json('csrf_token');

        $this->assertIsString($freshToken);
        $this->assertNotSame('stale-token', $freshToken);
        $this->assertSame($freshToken, $response->headers->get('X-CSRF-TOKEN'));
    }

    public function test_logout_returns_replacement_csrf_token(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->withSession(['_token' => 'before-logout']);

        $response = $this->postJson('/api/cms/logout');

        $response
            ->assertOk()
            ->assertHeader('X-CSRF-TOKEN')
            ->assertJsonStructure(['csrf_token']);

        $freshToken = $response->json('csrf_token');

        $this->assertIsString($freshToken);
        $this->assertNotSame('before-logout', $freshToken);
        $this->assertSame($freshToken, $response->headers->get('X-CSRF-TOKEN'));
    }
}
