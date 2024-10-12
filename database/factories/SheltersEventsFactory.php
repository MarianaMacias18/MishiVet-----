<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Shelter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SheltersEvents>
 */
class SheltersEventsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_refugio' => Shelter::factory()->create()->id, // Crea un nuevo shelter y obtiene su ID
            'id_evento' => Event::factory()->create()->id, // Crea un nuevo evento y obtiene su ID
            'ubicacion' => $this->faker->address, // Ubicación aleatoria
            'participantes' => $this->faker->numberBetween(1, 100), // Número aleatorio de participantes
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
