<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->createMany([
            [
                'name' => 'Electronica',
                'description' => 'Dispositivos y accesorios',
            ],
            [
                'name' => 'Hogar',
                'description' => 'Articulos para casa',
            ],
            [
                'name' => 'Oficina',
                'description' => 'Material y equipo de trabajo',
            ],
        ]);
    }
}
