<div class="card shadow-sm h-100">
    <img class="card-img-top" width="286" height="180" src="https://picsum.photos/286/180?{{ random_int(1,1000) }}" alt="{{ $product->name }}">
    <div class="card-body">
        <a class="stretched-link" href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
        <div class="card-title">{{ ReadableUnit::money($product->discounted_price) }}</div>
        <p class="card-text">{{ Str::limit($product->description) }}</p>
    </div>
</div>
