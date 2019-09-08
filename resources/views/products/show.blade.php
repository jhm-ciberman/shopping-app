@extends('layouts.app')

@section('content')
<div class="justify-content-center">
    <div class="row">
        <div class="col-auto mb-2 px-md-0 col-12 col-md-6 bg-light">
            <img class="img-fluid rounded w-100" width="430" height="300" src="{{ $product->mediumImage() }}" alt="{{ $product->name }}">
        </div>

        <div class="px-md-4 col-12 col-md-6">
            <div class="card border-0 shadow-sm border-0">
                <div class="card-body">
                    <div class="text-muted">SKU: {{ $product->sku }}</div>
                    <h1 class="card-title" href="{{ route('products.show', $product) }}">{{ $product->name }}</h1>
                    <p class="text-price-tag">{{ ReadableUnit::money($product->discounted_price) }}</p>
                    <p class="card-text">{{ $product->description }}</p>
                </div>

                <div class="card-footer">
                    <form method="POST" action="{{ route('cart.add', $product) }}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-form-label col-auto mr-3" for="quantity">Quantity</label>
                            <input class="form-control col-5" type="number" name="quantity" id="quantity" value="1" min="0" max="100">
                        </div>
                        <div class="row">
                            <input type="submit" class="col m-2 btn btn-lg btn-primary" value="Buy now">
                            <input type="submit" formaction="{{ route('cart.add', ['product' => $product, 'noshow' => true]) }}" class="col m-2 btn btn-lg btn-outline-primary" value="Add to cart">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
