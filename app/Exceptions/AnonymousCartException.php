<?php

namespace App\Exceptions;
use App\Cart;

class AnonymousCartException extends CartException
{
    /**
     * Constructs a new CartException
     * 
     * @param  App\Cart $cart
     */
    public function __construct(Cart $cart)
    {
        $this->message = "The cart cannot be an Anonymous Cart";
        $this->cart = $cart;
    }
}
