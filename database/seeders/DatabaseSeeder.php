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
*/

        \App\Models\DefaultTemplateSetting::factory()->create([
            'template_id' => 1,
            'base_font_size' => 1,
            'base_line_height' => 1.5,
            'name_size' => 1.8,
            'job_size' => 1.5,
            'section_size' => 1.6,
            'sidebar_section_size' => 1,
            'sidebar_font_size' => 0.8,
            'sidebar_line_height' => 1.2,
            'address_size' => 0.9,
            'address_line_height' => 1.3,
            'section_separation' => null,
            'photo_height' => null,
        ]);

        \App\Models\DefaultTemplateSetting::factory()->create([
            'template_id' => 2,
            'base_font_size' => 1,
            'base_line_height' => 1.5,
            'name_size' => 1.7,
            'job_size' => 1.3,
            'section_size' => 1.35,
            'sidebar_section_size' => 1.1,
            'sidebar_font_size' => 0.75,
            'sidebar_line_height' => 1.5,
            'address_size' => 0.8,
            'address_line_height' => 1.5,
            'section_separation' => null,
            'photo_height' => null,
        ]);

        \App\Models\DefaultTemplateSetting::factory()->create([
            'template_id' => 3,
            'base_font_size' => 0.8,
            'base_line_height' => 1.5,
            'name_size' => 1.3,
            'job_size' => 1.1,
            'section_size' => 1.2,
            'sidebar_section_size' => 1.1,
            'sidebar_font_size' => 0.6,
            'sidebar_line_height' => 1.5,
            'address_size' => 0.7,
            'address_line_height' => 1.5,
            'section_separation' => null,
            'photo_height' => null,
        ]);

    }
}
