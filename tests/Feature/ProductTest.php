<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Product;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $products = factory(Product::class, 3)->create(['discount' => 10]);

        $response = $this->get(route('products.index'));

        $response->assertStatus(200);

        $products->each(function($product) use ($response) {
            $response->assertSee($product->name);
            $response->assertSee($product->discounted_price);
        });
    }

    public function testShow()
    {
        $product = factory(Product::class)->create();

        $this->get(route('products.show', $product))
            ->assertStatus(200)
            ->assertSee($product->name)
            ->assertSee($product->discounted_price);
    }
}
