<?php

namespace App\Exceptions;

use Exception;
use App\Cart;

class MinimumCartAmountNotReachedException extends CartException
{
    /**
     * Constructs a new CartException
     * 
     * @param  App\Cart $cart
     */
    public function __construct(Cart $cart)
    {
        $this->message = "Minimum cart amount not reached";
        $this->cart = $cart;
    }
}
