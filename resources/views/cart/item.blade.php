<tr class="cart_item">
    @isset($editable)
        <td>
            <form method="POST" class="align-middle d-inline" action="{{ route('cart.remove', $item->product) }}">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm" aria-label="{{ __('Remove product') }}">
                    <i class="material-icons">delete</i>
                </button>
            </form>
        </td>
    @endisset

    <td class="cart-product-thumbnail">
        <a href="{{ route('products.show', $item->product) }}">
            <img class="rounded" width="64" height="64" src="{{ $item->product->thumbImage() }}" alt="{{ $item->product->name }}">
        </a>
    </td>

    <td class="cart-product-name">
        <a href="{{ route('products.show', $item->product) }}">{{ $item->product->name }}</a>
    </td>

    <td class="cart-product-subtotal">
        <span class="amount">
            @include('products.partials.price', ['product' => $item->product])
        </span>
    </td>

    <td class="cart-product-quantity">
        <div class="quantity clearfix">
            {{ ReadableUnit::quantity($item->quantity) }} {{ __('Units') }}
        </div>
    </td>

    <td class="cart-product-subtotal">
        <span class="amount">
            @include('products.partials.itemprice', ['item' => $item])
        </span>
    </td>
</tr>
