<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use App\Services\CartManager;

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }

    public function addAndPurchase(Product $product)
    {
        $this->addItemFromRequest($product);

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
