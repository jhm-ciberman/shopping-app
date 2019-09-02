<?php 

namespace App\Services;
use App\Exceptions\EmptyCartException;
use App\Exceptions\AnonymousCartException;
use App\Exceptions\MinimumCartAmountNotReachedException;
use App\Exceptions\InvalidQuantityException;

use App\Cart;

class CartValidator 
{
    public function validate(Cart $cart)
    {
        if ($cart->isAnonymous()) {
            throw new AnonymousCartException($cart);
        }

        if ($cart->isEmpty()) {
            throw new EmptyCartException($cart);
        }
    }
}