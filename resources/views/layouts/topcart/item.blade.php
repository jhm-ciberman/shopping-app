<div class="list-group-item">
    <div class="media">
        <img width="64" height="64" class="mr-3" src="{{ $item->product->thumbImage() }}" alt="{{ $item->product->name }}">
        <div class="media-body">
            <a href="{{ route('products.show', $item->product) }}" class="stretched-link">{{ $item->product->name }}</a>
            <span class="top-cart-item-price">
                @include('products.partials.price', ['product' => $item->product ])
            </span>
            <p class="top-cart-item-quantity mb-0">{{ ReadableUnit::quantity($item->quantity) }} Units</p>
        </div>
    </div>
</div>
