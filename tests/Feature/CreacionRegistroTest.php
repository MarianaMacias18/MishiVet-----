<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreacionRegistroTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_record()
    {
        $response = $this->post(route('users.store'), [
            'name' => 'Maik',
            'apellidoP' => 'Gomez',
            'apellidoM' => 'Diaz',
            'email' => 'mishi@gmail.com',
            'password' => 'admin123',
            'password_confirmation' => 'admin123', 
            'telefono' => '1234567890',          
            'direccion' => 'Calle Test 123',    
        ]);

        $response->assertRedirect(route('verification.notice'));
        $this->assertDatabaseHas('users', ['email' => 'mishi@gmail.com']);
    }
    public function test_user_can_access_create_route()
    {
        $this->get(route('users.create'))
            ->assertStatus(200)
            ->assertSee('Registro de Usuario'); 
    }

}
