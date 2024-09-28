<?php

namespace Database\Seeders;

use App\Models\Shelter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShelterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shelter::create([
            'nombre' => 'Refugio Animal Kitten',
            'direccion' => 'Calle de la Paz, 123',
            'telefono' => '33-11-22-33-44',
            'correo' => 'animalkitten@gmail.com',
            'descripcion' => 'Un refugio dedicado a la rescate de gatitos en situación de calle.',
            'id_usuario_dueño' => 1, // Usuario que exista en la BD
        ]);

        Shelter::create([
            'nombre' => 'Refugio Animal Love',
            'direccion' => 'Av. Esparza, 456',
            'telefono' => '33-55-66-77-88',
            'correo' => 'animallove@gmail.com',
            'descripcion' => 'Dedicado a encontrar hogares para gatitos abandonados.',
            'id_usuario_dueño' => 2, // Usuario que exista en la BD
        ]);
        Shelter::factory(10)->create(); 
    }
}
