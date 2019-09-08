@inject('cart', 'App\Services\CartManager')

<div class="dropdown">

    <a href="#" id="top-cart-trigger" class="mx-2 text-decoration-none" aria-label="{{ __('Show Cart') }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="material-icons" style="line-height: inherit;">shopping_cart</i>
        @if ($cart->items->count() > 0)
            <span class="badge badge-pill badge-primary align-top mx-n1">{{ $cart->items->count() }}</span>
        @endif
    </a>

    <div class="dropdown-menu dropdown-menu-right cart-dropdown border-0 shadow py-0" aria-labelledby="top-cart-trigger">
        <h2 class="dropdown-header">{{ __('Your Cart') }}</h2>
        <div class="list-group list-group-flush">
            @each('layouts.topcart.item', $cart->items, 'item', 'layouts.topcart.empty')
        </div>
        @if ($cart->items->count() > 0)
            <div class="card-footer">
                <div class="row">
                    <div class="fleft top-checkout-price py-1 col">{{ ReadableUnit::money($cart->discounted_total) }}</div>
                    <div class="col-auto">
                        <a href="{{ route('cart.show') }}" class="btn btn-primary button my-0 btn-small">{{ __('Show Cart') }}</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
