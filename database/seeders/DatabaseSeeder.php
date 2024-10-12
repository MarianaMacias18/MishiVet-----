<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Shelter;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    public function run(): void
    {
        
        $this->call([ //Seeders
            UserSeeder::class,
            //ShelterSeeder::class,
            //EventSeeder::class,
            ShelterEventSeeder::class,
            KittenSeeder::class,
            NotificationSeeder::class,
            //AdoptionUserKittenSeeder::class,   
        ]);
        
    }
}
