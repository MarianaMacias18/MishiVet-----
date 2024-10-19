<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kitten>
 */
class KittenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name, 
            'raza' => $this->faker->word, 
            'edad' => $this->faker->numberBetween(0, 5), 
            'sexo' => $this->faker->randomElement(['macho', 'hembra']), 
            'color' => $this->faker->colorName, 
            'detalles' => $this->faker->paragraph, 
            'foto' => null,// IMG específica
            'estado' => $this->faker->randomElement(['adoptado', 'apartado', 'libre']), // Estado aleatorio
            'id_refugio' => $this->faker->numberBetween(1, 5), // Rango según el número de refugios
            'id_usuario_creador' => $this->faker->numberBetween(1, 2), // Rango según el número de usuarios

        ];
    }
}
