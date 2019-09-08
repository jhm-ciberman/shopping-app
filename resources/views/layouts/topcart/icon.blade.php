@inject('cart', 'App\Services\CartManager')

<div class="dropdown">

    <a href="#" id="top-cart-trigger" class="mx-2" aria-label="{{ __('Show Cart') }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="material-icons" style="line-height: inherit;">shopping_cart</i>
        @if ($cart->items->count() > 0)
        <span class="badge badge-pill badge-primary">{{ $cart->items->count() }}</span>
        @endif
    </a>

    <div class="dropdown-menu dropdown-menu-right cart-dropdown" aria-labelledby="top-cart-trigger">
        <h4 class="dropdown-header">{{ __('Your Cart') }}</h4>
        <div class="p-4">
            @each('layouts.topcart.item', $cart->items, 'item', 'layouts.topcart.empty')
        </div>
        @if ($cart->items->count() > 0)
            <div class="top-cart-action clearfix">
                <span class="fleft top-checkout-price py-1">{{ ReadableUnit::money($cart->discounted_total) }}</span>
                <a href="{{ route('cart.show') }}" class="btn btn-primary button my-0 py-2 btn-small fright">{{ __('Show Cart') }}</a>
            </div>
        @endif
    </div>
</div>
