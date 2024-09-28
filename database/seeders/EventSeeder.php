<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::create([
            'nombre' => 'Jornada de Adopción de Kittens',
            'fecha' => now()->addDays(30), // Una fecha futura
            'descripcion' => 'Evento especial para promover la adopción de gatos y su cuidado.',
        ]);

        Event::create([
            'nombre' => 'Campaña de Vacunación',
            'fecha' => now()->addDays(60), // Asigna otra fecha futura
            'descripcion' => 'Campaña de vacunación gratuita para gatitos.',
        ]);
        Event::factory(10)->create();
    }
}
