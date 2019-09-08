<div class="card h-100">
    <img class="card-img-top img-fluid" width="183" height="137" src="{{ $product->smallImage() }}" alt="{{ $product->name }}">
    <div class="card-body">
        <a class="stretched-link" href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
        <div class="card-title">{{ ReadableUnit::money($product->discounted_price) }}</div>
        <p class="card-text">{{ Str::limit($product->description) }}</p>
    </div>
</div>
