<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Cart;
use App\CartItem;
use App\User;
use App\Address;
use App\Exceptions\EmptyCartException;
use App\Exceptions\AnonymousCartException;
use App\Exceptions\MinimumCartAmountNotReachedException;
use Configuration;
use App\Services\CartValidator;

class CartValidatorTest extends TestCase
{
    use RefreshDatabase;

    public function testToOrderShouldThrowEmptyCartException()
    {
        $this->expectException(EmptyCartException::class);
        
        $user = factory(User::class)->create();
        $cart = factory(Cart::class)->create(['user_id' => $user->id]);
        
        app(CartValidator::class)->validate($cart);
    }

    public function testToOrderShouldThrowAnonymousCartException()
    {
        $this->expectException(AnonymousCartException::class);
        
        $cart = factory(Cart::class)->create();
        
        app(CartValidator::class)->validate($cart);
    }

}
