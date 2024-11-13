<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MostrarRegistroTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_access_show_route_and_see()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('users.show', $user))
            ->assertStatus(200)
            ->assertSee($user->name); // Texto esperado en la vista. <-
    }
    public function test_user_can_access_edit_route_and_see()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('users.edit', $user))
            ->assertStatus(200)
            ->assertSee($user->name); // Texto esperado en la vista. <-
    }
}
