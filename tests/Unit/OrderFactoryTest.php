<?php
/*
namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Cart;
use App\Product;
use App\CartItem;
use App\Order;
use App\OrderItem;
use App\User;
use App\Address;
use App\Exceptions\EmptyCartException;
use App\Exceptions\AnonymousCartException;
use App\Exceptions\MinimumCartAmountNotReachedException;
use App\Exceptions\InvalidQuantityException;
use Configuration;

class OrderFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function testToOrderShouldCreateBasicOrder()
    {
        $user = factory(User::class)->create();
        $cart = factory(Cart::class)->create(['user_id' => $user->id]);
        $address = factory(Address::class)->create();
        factory(CartItem::class, 3)->create(['cart_id' => $cart->id]);
        
        $order = $user->cart->toOrder($address);

        $this->assertEquals($user->id, $order->user->id);
        $this->assertNotEquals($address->id, $order->address->id);
        $this->assertEquals($address->fullAddress, $order->address->fullAddress);
        $this->assertEquals(3, $order->items->count());
    }

    public function testAddItemsFromOrder()
    {
        $cart = factory(Cart::class)->create();
        $order = factory(Order::class)->create();
        factory(OrderItem::class, 3)->create(['order_id' => $order->id]);

        $cart->addItemsFromOrder($order);

        $this->assertEquals(3, $cart->fresh()->items->count());
    }

    public function testAddItemsFromOrderAndRejectExistingProducts()
    {
        $cart = factory(Cart::class)->create();
        $order = factory(Order::class)->create();
        factory(OrderItem::class, 3)->create(['order_id' => $order->id]);

        // 2nd Product will be already on the cart 
        $cart->add($order->items[1]->product);

        $cart->addItemsFromOrder($order);

        $this->assertEquals(3, $cart->fresh()->items->count());
    }

}
