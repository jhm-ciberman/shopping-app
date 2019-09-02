<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Cart;
use App\Product;
use App\CartItem;
use App\Exceptions\EmptyCartException;
use App\Exceptions\AnonymousCartException;
use App\Exceptions\MinimumCartAmountNotReachedException;
use Configuration;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function testShouldAddItems()
    {
        $cart = factory(Cart::class)->create();
        $product = factory(Product::class)->create();

        $this->assertEquals(0, $cart->items()->count());

        $cart->add($product, 3);

        $this->assertEquals(1, $cart->items()->count());
        $this->assertEquals($product->id, $cart->items[0]->product_id);
        $this->assertEquals(3, $cart->items[0]->quantity);
    }

    public function testRemove()
    {
        $cart = factory(Cart::class)->create();
        $product = factory(Product::class)->create();
        $item = factory(CartItem::class)->create([
            'cart_id'    => $cart->id,
            'product_id' => $product->id,
        ]);

        $this->assertEquals(1, $cart->items()->count());

        $cart->remove($product);

        $this->assertEquals(0, $cart->items()->count());
    }

    public function testHasProduct()
    {
        $cart = factory(Cart::class)->create();
        $product = factory(Product::class)->create();

        $this->assertFalse($cart->hasProduct($product));

        $cart->add($product, 3);

        $this->assertTrue($cart->fresh()->hasProduct($product));
    }
}
