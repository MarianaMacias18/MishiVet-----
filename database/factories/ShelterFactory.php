<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shelter>
 */
class ShelterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->company, 
            'direccion' => $this->faker->address, 
            'telefono' => $this->faker->phoneNumber, 
            'correo' => $this->faker->unique()->safeEmail, 
            'descripcion' => $this->faker->paragraph,
            'id_usuario_dueño' => $this->faker->numberBetween(1, 2), // Rango según el número de usuarios
        ];
    }
}
