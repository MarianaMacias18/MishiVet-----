<?php

namespace Database\Seeders;

use App\Models\AdoptionUserKitten;
use App\Models\Kitten;
use App\Models\Shelter;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdoptionUserKittenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Crear usuarios de ejemplo
         $user1 = User::create([
            'name' => 'Alice',
            'apellidoP' => 'Smith',
            'apellidoM' => 'Johnson',
            'email' => 'alice@example.com',
            'password' => bcrypt('password'), // Encriptar la contraseña
            'telefono' => '123-456-7890',
            'direccion' => '123 Main St',
        ]);

        $user2 = User::create([
            'name' => 'Bob',
            'apellidoP' => 'Brown',
            'apellidoM' => 'Williams',
            'email' => 'bob@example.com',
            'password' => bcrypt('password'), // Encriptar la contraseña
            'telefono' => '098-765-4321',
            'direccion' => '456 Elm St',
        ]);

        // Crear refugios de ejemplo
        $shelter1 = Shelter::create([
            'nombre' => 'Happy Tails Shelter',
            'direccion' => '789 Park Ave',
            'telefono' => '111-222-3333',
            'correo' => 'info@happytails.com',
            'descripcion' => 'A shelter dedicated to finding loving homes for cats.',
            'id_usuario_dueño' => $user1->id, // Asumiendo que el dueño es un usuario creado
        ]);

        $shelter2 = Shelter::create([
            'nombre' => 'Paws & Claws Rescue',
            'direccion' => '321 Pine St',
            'telefono' => '444-555-6666',
            'correo' => 'contact@pawsandclaws.com',
            'descripcion' => 'Rescue shelter for abandoned and stray cats.',
            'id_usuario_dueño' => $user2->id, // Asumiendo que el dueño es un usuario creado
        ]);

        // Crear gatitos de ejemplo
        $kitten1 = Kitten::create([
            'nombre' => 'Mittens',
            'raza' => 'Siamese',
            'edad' => 2,
            'sexo' => 'hembra',
            'color' => 'Blanco',
            'detalles' => 'Es muy juguetona y cariñosa.',
            'foto' => 'ruta/a/foto1.jpg',
            'estado' => 'libre',
            'id_refugio' => $shelter1->id,
        ]);

        $kitten2 = Kitten::create([
            'nombre' => 'Shadow',
            'raza' => 'Maine Coon',
            'edad' => 3,
            'sexo' => 'macho',
            'color' => 'Negro',
            'detalles' => 'Le encanta dormir y jugar.',
            'foto' => 'ruta/a/foto2.jpg',
            'estado' => 'libre',
            'id_refugio' => $shelter2->id,
        ]);
         // Registrar las adopciones
         AdoptionUserKitten::create([
            'fecha_adopcion' => '2024-09-01',
            'ubicacion_refugio' => $shelter1->direccion,
            'id_refugio' => $shelter1->id,
            'id_usuario_adoptivo' => $user1->id,
            'id_gato' => $kitten1->id,
        ]);

        AdoptionUserKitten::create([
            'fecha_adopcion' => '2024-09-02',
            'ubicacion_refugio' => $shelter2->direccion,
            'id_refugio' => $shelter2->id,
            'id_usuario_adoptivo' => $user2->id,
            'id_gato' => $kitten2->id,
        ]);
    }
}
