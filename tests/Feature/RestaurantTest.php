<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Restaurant;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RestaurantTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /** @test */
    public function endpoint_displays_all_restaurants()
    {
        $response = $this->get('/restaurants');

        $response->assertStatus(200);
        $response->assertSee('Green Restaurant');
        $response->assertSee('Blue Restaurant');
    }

    /** @test */
    public function endpoint_displays_all_tables_for_a_restaurant()
    {
        $restaurant = Restaurant::where('name', 'Green Restaurant')->first();
        $response = $this->get("/restaurants/{$restaurant->id}/tables");

        $response->assertStatus(200);
        $response->assertSee('Table 1');
        $response->assertSee('Table 2');
        $response->assertSee('Table 3');
        $response->assertSee('Table 4');
        $response->assertSee('Table 5');
        $response->assertSee('Table 6');
        $response->assertSee('Table 7');
    }
}
