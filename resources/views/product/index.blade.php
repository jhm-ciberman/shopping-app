<h1>Products index</h1>

@foreach($products as $product)
    <div>
        <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
        <p>{{ $product->price }}</p>
    </div>
@endforeach

{{ $products->links() }}