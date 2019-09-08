<div class="top-cart-items">
    <div class="top-cart-item clearfix">
        <div class="top-cart-item-image">
            <a href="{{ route('products.show', $item->product) }}">
                <img src="{{ $item->product->thumbImage() }}" alt="{{ $item->product->name }}">
            </a>
        </div>
        <div class="top-cart-item-desc">
            <a href="{{ route('products.show', $item->product) }}">{{ $item->product->name }}</a>
            <span class="top-cart-item-price">
                @include('products.partials.price', ['product' => $item->product ])
            </span>
            <span class="top-cart-item-quantity">{{ ReadableUnit::quantity($item->quantity) }}</span>
        </div>
    </div>
</div>
