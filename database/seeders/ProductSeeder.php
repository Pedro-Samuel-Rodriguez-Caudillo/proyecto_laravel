<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::factory(7)->create();

        Product::factory(30)->create()->each(function (Product $product) use ($categories): void {
            $product->categories()->attach(
                $categories->random(rand(1, min(3, $categories->count())))->pluck('id')->all()
            );
        });
    }
}
