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
            'raza' => 'Ragdoll',
            'edad' => 2,
            'sexo' => 'macho',
            'color' => 'Negro',
            'detalles' => 'Kitten que desaparece de día y vuelve de noche.',
            'foto' => null,
            'estado' => 'Libre',
            'id_refugio' => 1, 
            'id_usuario_creador' => 1, 
        ]);

        Kitten::create([
            'nombre' => 'Mimi',
            'raza' => 'Persa',
            'edad' => 3,
            'sexo' => 'hembra',
            'color' => 'Blanco',
            'detalles' => 'Kitten que solo come, duerme y le gustan los peluches de esfera.',
            'foto' => null,
            'estado' => 'Adoptado',
            'id_refugio' => 1, 
            'id_usuario_creador' => 1, 
        ]);
        Kitten::factory(10)->create();
    }
}
