<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Product;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 5)->create()->each(function($category) {
            $products = Product::inRandomOrder()->take(rand(10, 20))->get();
            $category->products()->attach($products);
        });
    }
}
