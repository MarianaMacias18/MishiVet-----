<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ValidacionPostTest extends TestCase
{
    use RefreshDatabase;

    public function test_post_request_with_invalid_data_fails_validation()
    {
        $response = $this->post(route('users.store'), [
            'name' => '',
            'email' => 'not-an-email',
            'password' => 'short',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }
}
