<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        if ($categories->isEmpty()) {
            $categories = Category::factory(10)->create();
        }

        Product::factory(100)
            ->hasAttached($categories->random(3))
            ->create();


        Product::factory()
            ->hasAttached($categories->random(2))
            ->create([
                'Name' => 'Holis',
                'Description' => 'Muy buen producto',
            ]);
    }
    /*
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
    }*/

    /*
     *         // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
     */
}
