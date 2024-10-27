<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActualizacionRegistroTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_update_record()
    {
        // Usuario nuevo con datos aleatorios 
        $user = User::factory()->create();

        // "actingAs" Simula al usuario
        $this->actingAs($user);

        // Realiza una solicitud PUT para actualizar el registro
        $response = $this->put(route('users.update', $user), [
            'name' => 'Testito',
            'apellidoP' => 'Mujia',
            'apellidoM' => 'Ramirez',
            'email' => 'mishitestito@gmail.com',
            'password' => '123adminins', 
            'password_confirmation' => '123adminins', 
            'telefono' => '098765432112',          
            'direccion' => 'Street Hoom Back 123',  
        ]);

        // Verifica que se redirija a la ruta luego de la actualización
        $response->assertRedirect(route('users.edit', $user->fresh())); // "Fresh()" obtiene el modelo actualizado

        // Verifica que el registro se haya actualizado en la BD
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Testito',
            'apellidoP' => 'Mujia',
            'apellidoM' => 'Ramirez',
            'email' => 'mishitestito@gmail.com',
            'telefono' => '098765432112',          
            'direccion' => 'Street Hoom Back 123',  
        ]);
    }


    public function test_update_record_with_invalid_data_fails_validation()
    {
        // Crea un usuario a actualizar
        $user = User::factory()->create();

        // Simula al usuario con "actingAs"
        $this->actingAs($user);

        // Realiza una solicitud PUT con datos inválidos
        $response = $this->put(route('users.update', $user), [
            'name' => '', // Nombre vacío <-
            'email' => 'not-an-email', // Correo no válido <-
        ]);

        // Verifica que haya errores en la sesión en los campos dados
        $response->assertSessionHasErrors(['name', 'email']);
    }
}
