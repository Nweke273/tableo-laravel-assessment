<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuotesApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_quote_endpoint_returns_5_random_kanye_west_quotes()
    {
        $user = User::factory()->create([
            'password' => Hash::make('12345678'),
        ]);

        $device = 'TestDevice';
        $expiresAt = now()->addMinutes(config('session.lifetime'));
        $token = $user->createToken($device, [$expiresAt])->plainTextToken;

        $response = $this->getJson('/api/quotes', [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200);

        $this->assertCount(5, $response->json());
    }

    /** @test */
    public function test_quote_endpoint_secured_with_token()
    {
        $response = $this->getJson('/api/quotes');

        $response->assertStatus(401);
    }
}
