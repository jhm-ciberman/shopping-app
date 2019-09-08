<div class="table-responsive">
    <table class="table cart">
        <thead>
            <tr>
                <th class="cart-product-thumbnail">&nbsp;</th>
                <th class="cart-product-name">{{ __('Product') }}</th>
                <th class="cart-product-quantity">{{ __('Unit Price') }}</th>
                <th class="cart-product-quantity">{{ __('Quantity') }}</th>
                <th class="cart-product-subtotal">{{ __('Delivered') }}</th>
                <th class="cart-product-subtotal">{{ __('Total') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr class="cart_item">
                    <td class="cart-product-thumbnail">
                        @if ($item->product->trashed())
                            <img width="64" height="64" src="{{ $item->product->thumbImage() }}" alt="{{ $item->product->name }}">
                        @else
                            <a href="{{ route('products.show', $item->product) }}">
                                <img width="64" height="64" src="{{ $item->product->thumbImage() }}" alt="{{ $item->product->name }}">
                            </a>
                        @endif
                    </td>

                    <td class="cart-product-name">
                        @if ($item->product->trashed())
                            <span class="text-muted">{{ $item->product->name }}</a>
                        @else
                            <a href="{{ route('products.show', $item->product) }}">{{ $item->product->name }}</a>
                        @endif
                    </td>

                    <td class="cart-product-subtotal">
                        <span class="amount">
                            @include('products.partials.price', ['product' => $item])
                        </span>
                    </td>

                    <td class="cart-product-quantity">
                        <div class="quantity clearfix">
                            {{ ReadableUnit::quantity($item->quantity) }} {{ ReadableUnit::short($item->product->unit_type) }}
                        </div>
                    </td>

                    <td class="cart-product-quantity">
                        <div class="quantity clearfix">
                            @if (filled($item->real_delivered_quantity))
                                {{ ReadableUnit::quantity($item->real_delivered_quantity) }} {{ ReadableUnit::short($item->product->unit_type) }}
                            @else
                                &mdash;
                            @endif
                        </div>
                    </td>

                    <td class="cart-product-subtotal">
                        <span class="amount">
                            @include('products.partials.delivereditemprice', ['item' => $item])
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>