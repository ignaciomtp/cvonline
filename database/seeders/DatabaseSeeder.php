<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
/*
        \App\Models\User::factory()->create([
             'name' => 'Ignacio',
             'email' => 'ignaciomtp@gmail.com',
             'password' => '$2y$10$5c6rfAtkS34oXKSQ38ySk.Z0YBzbeo6McPCz4WJ6FjaRy8JK5U6CW',
             'role' => 'Admin',
             'surname' => 'Martínez Pérez',
             'phone' => '634610794',
             'job' => 'Programador Web',
             'address' => 'Avda de La Coruña 92 6A',
             'zip' => '15960',
             'city' => 'Ribeira',
             'province' => 'La Coruña',
             'country' => 'España',
             'photo' => '1752915635.foto-carnet4.jpg',
             'web' => '',
             'profile' => 'https://www.linkedin.com/in/ignacio-martinez-perez/'

         ]);

*/
        \App\Models\Template::factory()->create([
            'name' => 'Plantilla 1',
            'view' => 'cv1',
            'active' => 1
        ]);

        \App\Models\Template::factory()->create([
            'name' => 'Plantilla 2',
            'view' => 'cv2',
            'active' => 1
        ]);

        \App\Models\Template::factory()->create([
            'name' => 'Plantilla 3',
            'view' => 'cv3',
            'active' => 1
        ]);

    }
}
