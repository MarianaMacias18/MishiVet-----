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
            'raza' => $this->faker->randomElement([
                'Persa',
                'Siamés',
                'Bengalí',
                'Maine Coon',
                'Sphynx',
                'Scottish Fold',
                'Ragdoll',
                'Birmano',
                'Británico de pelo corto',
                'Chartreux',
                'Mezclada'
            ]),
            'edad' => $this->faker->numberBetween(1, 15),
            'sexo' => $this->faker->randomElement(['macho', 'hembra']),
            'color' => $this->faker->randomElement([
                'Blanco',
                'Negro',
                'Gris',
                'Marrón',
                'Atigrado',
                'Bicolor',
                'Tricolor',
                'Siamés',
                'Tabby',
                'Persa',
                'Naranjiño',
                'Multicolor'
            ]),
            'detalles' => $this->faker->paragraph,
            'foto' => null, // IMG específica
            'estado' => $this->faker->randomElement(['adoptado', 'apartado', 'libre']), // Estado aleatorio
            'id_refugio' => $this->faker->numberBetween(1, 5), // Rango según el número de refugios
            'id_usuario_creador' => $this->faker->numberBetween(1, 2), // Rango según el número de usuarios
        ];
    }
}
