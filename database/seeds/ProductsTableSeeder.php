<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Services\FakeImage\FakeImageFactory;

class ProductsTableSeeder extends Seeder
{
    use WithProgress;

    protected $quantity = 50;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $progressBar = $this->progress($this->quantity);

        $images = app(FakeImageFactory::class)->make($this->quantity); // Make 50 fake images

        factory(Product::class, $this->quantity)
            ->create()
            ->zip($images)
            ->eachSpread(function($product, $image) use ($progressBar) {
                $product->addMedia($image->getPath())
                    ->preservingOriginal()
                    ->toMediaCollection();

                $progressBar->advance();
            });

        $progressBar->finish();
    }
}
