<?php

namespace App\Services;

use App\Order;
use App\Cart;

class OrderFactory 
{

    /**
     * Creates a new Order from the current Cart instance
     * 
     * @param  App\Address  $shippingAddress 
     * @param  App\ShippingPeriod  $shippingPeriod
     * @return  App\Order
     * @throws  App\Exceptions\EmptyCartException
     * @throws  App\Exceptions\AnonymousCartException
     */
    public function fromCart(Cart $cart, Address $shippingAddress)
    {
        $order = Order::create([
            'user_id'    => $cart->user->id,
            'address_id' => $shippingAddress->replicateAndFreeze()->id,
        ]);

        $order->addItemsFromCart($cart);

        return $order;
    }

    /**
     * Add all the items from the specified cart
     * 
     * @return void
     */
    public function addCartItemsFromOrder(Cart $cart, Order $order)
    {
        if (! $cart->exists) {
            $cart->save();
        }

        $items = $order->items
            ->reject->invalidProduct()
            ->reject(function($item) {
                return $cart->hasProduct($item->product);
            });
            
        $cart->items()->saveMany($items->map->toCartItem());
    }
}