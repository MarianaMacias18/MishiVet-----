<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Shelter;
use App\Models\SheltersEvents;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShelterEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shelter1 = Shelter::inRandomOrder()->first(); // Obtener un refugio aleatorio de la BD
        $shelter2 = Shelter::inRandomOrder()->first(); 

        $event1 = Event::inRandomOrder()->first(); // Obtener un evento aleatorio de la BD
        $event2 = Event::inRandomOrder()->first(); 

        // Primer registro en la tabla pivote
        SheltersEvents::create([
            'id_refugio' => $shelter1->id,
            'id_evento' => $event1->id,
            'ubicacion' => 'Parque Central Michigan',
            'participantes' => 50,
        ]);

        // Segundo registro en la tabla pivote
        SheltersEvents::create([
            'id_refugio' => $shelter2->id,
            'id_evento' => $event2->id,
            'ubicacion' => 'Centro de Eventos Local',
            'participantes' => 30,
        ]);
    }
}
