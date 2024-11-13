<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RutaYTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_access_route_and_see_text()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('dashboard.index'))
            ->assertStatus(200)
            ->assertSee('Dashboard'); // Texto esperado en la vista. <-
    }
}
