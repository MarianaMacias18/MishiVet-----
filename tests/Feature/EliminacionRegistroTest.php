<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EliminacionRegistroTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_delete_record()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->delete(route('users.destroy', $user));

        $response->assertRedirect(route('users.loginshow'));

        $this->assertSoftDeleted('users', ['id' => $user->id]);
    }
}
