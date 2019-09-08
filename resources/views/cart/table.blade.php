<div class="table-responsive">
    <table class="table cart">
        <thead>
            <tr>
                @isset($editable)
                    <th class="">&nbsp;</th>
                @endisset
                <th class="cart-product-thumbnail">&nbsp;</th>
                <th class="cart-product-name">{{ __('Product') }}</th>
                <th class="cart-product-quantity">{{ __('Unit Price') }}</th>
                <th class="cart-product-quantity">{{ __('Quantity') }}</th>
                @isset($withDelivered)
                    <th class="cart-product-subtotal">{{ __('Delivered') }}</th>
                @endif
                <th class="cart-product-subtotal">{{ __('Total') }}</th>

            </tr>
        </thead>
        <tbody>
            @foreach($cart->items as $item)
                @include('cart.item', [
                    'item' => $item,
                    'editable' => $editable ?? null,
                    'withDelivered' => $withDelivered ?? null,
                ])
            @endforeach
        </tbody>
    </table>
</div>