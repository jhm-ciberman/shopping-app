<div class="table-responsive">
    <table class="table cart">
        <tbody>
            <tr class="cart_item">
                <td class="notopborder cart-product-name">
                    <strong>{{ __('Subtotal') }}</strong>
                </td>

                <td class="notopborder cart-product-name">
                    <span class="amount">{{ ReadableUnit::money($cart->total) }}</span>
                </td>
            </tr>

            @if ($cart->has_discount)
                <tr class="cart_item">
                    <td class="notopborder cart-product-name">
                        <strong>{{ __('Discount') }}</strong>
                    </td>

                    <td class="notopborder cart-product-name">
                        <span class="amount">{{ ReadableUnit::money($cart->discount) }}</span>
                    </td>
                </tr>
            @endif

            <tr class="cart_item">
                <td class="cart-product-name">
                    <strong>{{ __('Shipping') }}</strong>
                </td>

                <td class="cart-product-name">
                    <span class="amount">{{ __('Free Shipping!') }}</span>
                </td>
            </tr>

            <tr class="cart_item">
                <td class="cart-product-name">
                    <strong>{{ __('Total') }}</strong>
                </td>

                <td class="cart-product-name">
                    <span class="amount color lead"><strong>{{ ReadableUnit::money($cart->discounted_total) }}</strong></span>
                </td>
            </tr>
        </tbody>
    </table>
</div>
