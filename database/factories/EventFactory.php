<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->sentence(3), // Genera un nombre de evento aleatorio
            'fecha' => $this->faker->dateTimeBetween('now', '+6 months'), // Genera una fecha aleatoria en los próximos 6 meses
            'descripcion' => $this->faker->paragraph, 
            'id_usuario_dueño' => $this->faker->numberBetween(1, 2), // Rango según el número de usuarios
        ];
    }
}
