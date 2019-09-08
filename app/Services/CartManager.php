<?php

namespace App\Services;

use App\User;
use App\Cart;
use App\Order;
use App\Address;
use App\Product;
use Illuminate\Support\Traits\ForwardsCalls;

class CartManager
{
    use ForwardsCalls;

    /**
     * @var string The key in session that holds the cart id
     */
    protected $sessionKey = 'cart_id';

    /**
     * @var Cart The Cart model instance
     */
    protected $cart;

    /**
     * @var User The user model
     */
    protected $user;

    /**
     * Returns the encapsulated ActiveRecord model or null if not exists
     *
     * @return Cart
     */
    public function model()
    {
        return $this->cart ?? $this->restoreCart() ?? $this->createCart();
    }

    /**
     * Restores the last cart used by the user, or stored in the session
     *
     * @return Cart | null
     */
    protected function restoreCart()
    {
        $cart = $this->findCart($this->getCartId());

        if ($cart) {
            $this->setCart($cart);
        }

        return $cart;
    }

    /**
     * Finds the cart with the specified id
     *
     * @param  int  $id
     * @return Cart | null
     */
    protected function findCart($id)
    {
        return Cart::find($id);
    }

    /**
     * Completely destroys the cart: removes all related models (cart, item, etc) from the DB
     *
     * @return void
     */
    public function destroy()
    {
        $this->model()->delete();
        $this->forget();
    }

    /**
     * Forget the cart for the session, but keep it
     *
     * @return void
     */
    public function forget()
    {
        $this->cart = null;
        session()->forget($this->sessionKey);
    }

    /**
     * Returns the model id of the cart for the current session
     * or null if it does not exist
     *
     * @return int|null
     */
    protected function getCartId()
    {
        return session($this->sessionKey);
    }

    /**
     * Creates a new cart model and saves it's id in the session
     *
     * @return Cart
     */
    protected function createCart()
    {
        $model = $this->newCart();

        $this->setCart($model);

        return $model;
    }

    /**
     * Creates a new cart
     *
     * @return Cart
     */
    protected function newCart()
    {
        return new Cart();
    }

    /**
     * Sets the current cart, and asociate it with the logged
     * user and/or store it in the current session
     *
     * @param  Cart  $cart
     * @return self
     */
    public function setCart(Cart $cart)
    {
        $this->cart = $cart;

        $this->vinculateUserCart();

        $this->putInSession();

        return $this;
    }

    /**
     * Vinculates the current attached user and the current cart together
     *
     * @return void
     */
    protected function vinculateUserCart()
    {
        if ($this->cart && $this->user && $this->user->exists) {
            $this->cart->user_id = $this->user->id;

            if (! $this->cart->isEmpty()) {
                $this->cart->save();
            }
        }
    }

    /**
     * Sets the user
     *
     * @param  \App\User  $user
     * @return self
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        $this->vinculateUserCart();

        return $this;
    }

    /**
     * Sets the user
     *
     * @param  \App\User  $user
     * @return self
     */
    public function actingAs(User $user)
    {
        return $this->setUser($user);
    }

    /**
     * puts the current cart id in the session
     *
     * @return void
     */
    private function putInSession()
    {
        if ($this->cart && $this->cart->exists) {
            session([$this->sessionKey => $this->cart->getKey()]);
        }
    }

    /**
     * Add a product to the cart
     *
     * @param  $product
     * @param  $quantity
     * @return \App\Product
     */
    public function add(Product $product, $quantity = 1)
    {
        $product = $this->model()->add($product, $quantity);

        $this->putInSession();
        $this->vinculateUserCart();

        return $product;
    }

    /**
     * Add products from an order
     *
     * @param  $order
     * @return self
     */
    public function addItemsFromOrder($order)
    {
        $cartItems = $order->items
            ->reject->invalidProduct()
            ->map->toCartItem();

        $this->model()->addMany($cartItems);

        $this->putInSession();
        $this->vinculateUserCart();

        return $this;
    }

    /**
     * Creates a new Order from the current Cart instance
     *
     * @param  App\Address  $shippingAddress
     * @param  App\ShippingPeriod  $shippingPeriod
     * @return  App\Order
     * @throws  App\Exceptions\EmptyCartException
     * @throws  App\Exceptions\AnonymousCartException
     */
    public function createOrder(Address $shippingAddress)
    {
        $cart = $this->model();

        $data = array_merge($cart->toOrder(), [
            'address_id' => $shippingAddress->replicateAndFreeze()->id,
        ]);

        $order = Order::create($data);

        $orderItems = $cart->items->map->toOrderItem();

        $order->items()->createMany($orderItems->toArray());

        return $order;
    }

    /**
     * Removes a product from the cart
     *
     * @param  $productOrItem
     * @return bool
     */
    public function remove($productOrItem)
    {
        $model = $this->model();

        $removed = $model->remove($productOrItem);

        return $removed;
    }



    /**
     * Handle dynamic method calls into the model.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->forwardCallTo($this->model(), $method, $parameters);
    }

    /**
     * Dynamically retrieve attributes on the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->model()->{$key};
    }

    /**
     * Dynamically set attributes on the model.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->model()->{$key} = $value;
    }
}
