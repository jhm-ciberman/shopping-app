<?php

namespace App\Http\Controllers;

use App\Services\CartManager;
use Auth;
use App\Address;
use App\Product;
use App\Http\Requests\AddressForm;
use App\Http\Requests\PurchaseForm;
use App\Notifications\OrderConfirmed;
use Log;

class PurchaseController extends Controller
{

    /**
     * Creates a new controller instance
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Shows the creation page for the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CartManager $cart)
    {
        if ($cart->isEmpty()) {
            Log::warning('User attempted to make a purchase with an empty cart', $this->getContextualData($cart));

            return redirect()->route('cart.show');
        }

        $addresses = Auth::user()->addresses;

        if ($addresses->isEmpty()) {
            return redirect()->route('purchase.address.create');
        }

        return view('purchase.create', [
            'addresses'       => $addresses,
            'cart'            => $cart,
            'checksum'        => $cart->checksum(),
            'recentProducts'  => Product::getRecent(10),
        ]);
    }

    /**
     * Store the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseForm $request, CartManager $cartManager)
    {
        $cart = $cartManager->model();

        if (! $cart->checkChecksum($request->input('checksum'))) {
            Log::warning('User attempted to perform a purchase with an invalid checksum', $this->getContextualData($cart));
            return redirect()->back()->with('error', __('exceptions.checksum'));
        }

        $address = Auth::user()->addresses()->find($request->input('address'));

        $cart->user_id = Auth::id();

        $order = $cartManager->createOrder($address);

        Log::info('New purchase order created', ['order_id' => $order->id, 'user_id' => $order->user_id]);

        $cartManager->destroy();

        //Auth::user()->notify(new OrderConfirmed($order));

        return redirect()->route('purchase.success');

    }

    /**
     * Shows the purchase success screen
     *
     * @return \Illuminate\Http\Response
     */
    public function success()
    {
        Log::info('purchase success screen shown', ['user_id' => Auth::id()]);

        return view('purchase.success');
    }

    /**
     * Shows the purchase error screen
     *
     * @return \Illuminate\Http\Response
     */
    public function error()
    {
        Log::warning('purchase error screen shown', ['user_id' => Auth::id()]);

        return view('purchase.error');
    }

    /**
     * Shows the creation page for the first address of the user
     *
     * @return \Illuminate\Http\Response
     */
    public function addressCreate()
    {
        return view('purchase.address.create', [
            'address' => new Address(),
        ]);
    }

    /**
     * Store the first address of the user
     *
     * @return \Illuminate\Http\Response
     */
    public function addressStore(AddressForm $request)
    {
        $request->user()->addAddress($request->validated());

        return redirect()->route('purchase.create');
    }

    /**
     * Creates an array with contextual data about the purchase for logging
     *
     * @return array
     */
    protected function getContextualData($cart)
    {
        return [
            'user_id' => Auth::id(),
            'user_email' => Auth::user()->email,
            'cart_id' => $cart->id
        ];
    }
}
