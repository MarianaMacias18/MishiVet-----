<?php

namespace Database\Seeders;

use App\Models\Kitten;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KittenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kitten::create([
            'nombre' => 'Kitten Negrosito',
            'raza' => 'Siamés',
            'edad' => 2,
            'sexo' => 'macho',
            'color' => 'Negro',
            'detalles' => 'Kitten que desaparece de día y vuelve de noche.',
            'foto' => 'ruta/a/la/foto1.jpg',
            'estado' => 'libre',
            'id_refugio' => 1, 
        ]);

        Kitten::create([
            'nombre' => 'Mimi',
            'raza' => 'Persa',
            'edad' => 3,
            'sexo' => 'hembra',
            'color' => 'Blanco',
            'detalles' => 'Kitten que solo come, duerme y le gustan los peluches de esfera.',
            'foto' => 'ruta/a/la/foto2.jpg',
            'estado' => 'adoptado',
            'id_refugio' => 1, 
        ]);
        Kitten::factory(10)->create();
    }
}