<?php

namespace App\Exceptions;

use Exception;
use App\Cart;

abstract class CartException extends Exception
{
    /**
     * The cart
     * 
     * @var  App\Cart
     */
    public $cart;

    /**
     * Constructs a new CartException
     * 
     * @param  App\Cart $cart
     */
    public function __construct(Cart $cart)
    {
        parent::__construct("Invalid cart");
        $this->cart = $cart;
    }

    /**
     * Render the exception into a response
     */
    public function render()
    {
        return view('purchase.error', [
            'error' => $this,
        ]);
    }
}
