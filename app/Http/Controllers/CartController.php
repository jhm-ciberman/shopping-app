<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use App\Services\CartManager;
use Session;

class CartController extends Controller
{

    /**
     * The cart manager instance
     *
     * @var CartManager
     */
    private $cart;

    /**
     * Creates a new controller instance
     *
     * @param  CartManager  $cart
     */
    public function __construct(CartManager $cart)
    {
        $this->middleware('auth')->only('confirm');

        $this->cart = $cart;
    }


    public function show()
    {
        if ($this->cart->isEmpty()) {
            return view('cart.empty');
        }

        return view('cart.show', [
            'cart'            => $this->cart,
            'recentProducts'  => Product::getRecent(10),
        ]);
    }

    protected function getShippingDate()
    {
        return transform($this->getShippingPeriods(), function($periods) {
            return $periods->first()->resolveDate();
        });
    }

    protected function getShippingPeriods()
    {
        return transform(Auth::user(), function($user) {
            return ShippingPeriod::getShippingPeriods($user);
        });
    }

    public function ajaxEditForm(Product $product, Request $request)
    {
        $item = $this->cart->findItem($product);

        return (!$item)
            ? view('cart.ajax.404')
            : view('cart.ajax.edit', ['item' => $item, 'product' => $item->product]);
    }

    public function remove(Product $product, Request $request)
    {
        $this->cart->remove($product);

        return redirect()->route('cart.show');
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'nullable|numeric',
        ]);

        $quantity = $request->input('quantity', $product->amount_min);

        $item = $this->cart->add($product, $quantity);

        return $request->input('noshow')
            ? $this->redirectToIndex($item)
            : $this->redirectToCartShow();
    }

    protected function redirectToPurchase()
    {
        return redirect()->route('cart.show');
    }

    protected function redirectToCartShow()
    {
        return redirect()->route('cart.show');
    }
}
